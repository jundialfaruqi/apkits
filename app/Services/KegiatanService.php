<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KegiatanService
{
    public function getDatatables()
    {
        $kegiatan = DB::table('kegiatans')->select('id', 'nama_kegiatan');

        return DataTables::of($kegiatan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('admin.partials.kegiatan-actions', compact('row'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
