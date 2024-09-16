<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $title = "Data Permission";

        if (request()->ajax()) {
            $permissions = DB::table('permissions')->select('id', 'name');
            return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('admin/permissions/' . $row->id . '/edit');
                    $deleteUrl = url('admin/permissions/' . $row->id);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm rounded-pill my-1 px-2">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('role-permission.permission.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah Permission Baru";
        return view('role-permission.permission.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:permissions,name',
            ],
            [
                'name.unique' => 'Permission ini sudah ada',
                'name.required' => 'Permission tidak boleh kosong, harus diisi',
            ],
        );

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return redirect('admin/permissions')->with('success', 'Permission created successfully');
    }

    public function edit(Permission $permission)
    {
        $title = "Ubah Permission";
        return view('role-permission.permission.edit', [
            'title' => $title,
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:permissions,name,' . $permission->id,
            ],
            [
                'name.unique' => 'Permission ini sudah ada',
                'name.required' => 'Permission harus diisi',
            ],
        );

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect('admin/permissions')->with('success', 'Permission updated successfully');
    }

    public function destroy($permissionsId)
    {
        // Cari permission berdasarkan id
        $permission = DB::table('permissions')->where('id', $permissionsId)->first();

        // Jika permission ditemukan, hapus data
        if ($permission) {
            DB::table('permissions')->where('id', $permissionsId)->delete();
            return redirect('admin/permissions')->with('success', 'Permission deleted successfully');
        } else {
            return redirect('admin/permissions')->with('error', 'Permission not found');
        }
    }
}
