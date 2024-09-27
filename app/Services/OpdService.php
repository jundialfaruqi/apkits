<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OpdService
{

    public function getDatatables()
    {
        $opd = DB::table('opds')->select('id', 'name');

        return DataTables::of($opd)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('admin.partials.opd-actions', compact('row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
