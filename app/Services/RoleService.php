<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoleService
{
    public function getDatatables()
    {
        $roles = DB::table('roles')->select('id', 'name');
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('admin.partials.role-actions', compact('row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
