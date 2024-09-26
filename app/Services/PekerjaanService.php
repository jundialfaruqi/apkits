<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanService
{
    public function getDatatables()
    {
        $pekerjaan = DB::table('pekerjaans')->select('id', 'nama_pekerjaan');
        return DataTables::of($pekerjaan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('admin.partials.pekerjaan-actions', compact('row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
