<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    public function getUsersQuery()
    {
        $query = User::with(['roles', 'opd', 'formatlaporan.pekerjaanRelasi']);

        if (Auth::user()->hasRole('admin')) {
            $query->where('opd_id', Auth::user()->opd_id);
        }

        return $query;
    }

    public function getDatatables($users)
    {
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('opd', fn($user) => $user->opd ? $user->opd->name : 'N/A')
            ->addColumn('bidang', fn($user) => $user->formatlaporan ? $user->formatlaporan->bidang : 'N/A')
            ->addColumn('nama_pekerjaan', fn($user) => $this->getNamaPekerjaan($user))
            ->addColumn('roles', fn($user) => view('admin.partials.user-roles', compact('user'))->render())
            ->addColumn('action', fn($user) => view('admin.partials.user-actions', compact('user'))->render())
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    private function getNamaPekerjaan($user)
    {
        if ($user->formatlaporan && $user->formatlaporan->pekerjaanRelasi) {
            return $user->formatlaporan->pekerjaanRelasi->nama_pekerjaan ?? 'N/A';
        }
        return 'N/A';
    }
}
