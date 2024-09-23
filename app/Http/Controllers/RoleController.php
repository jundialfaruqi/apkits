<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Data Role";

        if (request()->ajax()) {
            $roles = DB::table('roles')->select('id', 'name');
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('admin/roles/' . $row->id . '/edit');
                    $deleteUrl = url('admin/roles/' . $row->id . '/delete');
                    $givePermissionUrl = url('admin/roles/' . $row->id . '/give-permissions');

                    return '
                        <a href="' . $editUrl . '" class="btn btn-icon btn-link rounded-pill text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        </a>
                        <a href="' . $deleteUrl . '" class="btn btn-icon btn-link rounded-pill text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        </a>
                        <a href="' . $givePermissionUrl . '" class="btn btn-icon btn-link rounded-pill text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Give Permission">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-certificate"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" /><path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" /><path d="M6 9l12 0" /><path d="M6 12l3 0" /><path d="M6 15l2 0" /></svg>
                        </a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('role-permission.role.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah Role Baru";
        return view('role-permission.role.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:roles,name',
            ],
            [
                'name.unique' => 'Role ini sudah ada',
                'name.required' => 'Role harus diisi',
            ],
        );

        $permission = Role::create([
            'name' => $request->name,
        ]);

        return redirect('admin/roles')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $title = "Ubah Role";
        return view('role-permission.role.edit', [
            'title' => $title,
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:roles,name,' . $role->id,
            ],
            [
                'name.unique' => 'Role ini sudah ada',
                'name.required' => 'Role harus diisi',
            ],
        );

        $role->update([
            'name' => $request->name,
        ]);

        return redirect('admin/roles')->with('success', 'Role updated successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('admin/roles')->with('success', 'Role deleted successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $title = "Role Permission";
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'title' => $title,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'Permission added to role');
    }
}
