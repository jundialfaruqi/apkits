<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->roleService->getDatatables();
        }

        $title = "Data Role";
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
