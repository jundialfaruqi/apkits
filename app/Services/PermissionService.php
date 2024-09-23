<?php

namespace App\Services;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    public function getDatatables()
    {
        $permissions = DB::table('permissions')->select('id', 'name');
        return DataTables::of($permissions)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('admin.partials.permission-actions', compact('row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
