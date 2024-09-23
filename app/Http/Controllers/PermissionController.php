<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PermissionService;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index()
    {
        $title = "Data Permission";

        if (request()->ajax()) {
            return $this->permissionService->getDatatables();
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
