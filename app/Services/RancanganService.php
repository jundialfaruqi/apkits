<?php

namespace App\Services;

use App\Models\Rancangan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Request;

class RancanganService
{
    public function getDatatables($user, $isSuperAdmin, $isAdmin)
    {
        $rancangans = Rancangan::with(['user.roles', 'kegiatan', 'user.opd'])
            ->select('rancangans.*');

        $this->applyFilters($rancangans, $user, $isAdmin);

        $rancangans->orderBy('rancangans.created_at', 'desc');

        return DataTables::of($rancangans)
            ->addIndexColumn()
            ->addColumn('user_name', fn($rancangan) => $rancangan->user->name)
            ->addColumn('kegiatan_nama', fn($rancangan) => $rancangan->kegiatan->nama_kegiatan)
            ->addColumn('action', fn($rancangan) => $this->getActionColumn($rancangan, $isSuperAdmin))
            ->editColumn('progress', fn($rancangan) => $rancangan->progress . '%')
            ->rawColumns(['user_roles', 'action'])
            ->make(true);
    }

    private function applyFilters($query, $user, $isAdmin)
    {
        if (Request::has('opd_id') && Request::input('opd_id') != '') {
            $query->whereHas('user', function ($q) {
                $q->where('opd_id', Request::input('opd_id'));
            });
        } elseif ($isAdmin) {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('opd_id', $user->opd_id);
            });
        }
    }

    private function getActionColumn($rancangan, $isSuperAdmin)
    {
        if (!$isSuperAdmin) return '';
        return view('admin.partials.rancangan-actions', compact('rancangan'))->render();
    }
}
