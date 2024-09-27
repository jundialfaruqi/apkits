<?php

namespace App\Services;

use App\Models\Kesimpulan;
use Yajra\DataTables\Facades\DataTables;

class KesimpulanService
{
    public function getDatatables($user, $canViewAll, $canView, $isSuperAdmin)
    {
        $kesimpulans = Kesimpulan::with('user')->select('kesimpulans.*');

        if ($canViewAll || $isSuperAdmin) {
            // User can view all data
        } elseif ($canView) {
            // User can only view their own data
            $kesimpulans->where('user_id', $user->id);
        }

        // Filter berdasarkan bulan dan tahun
        if (request()->has('bulan') && request()->has('tahun')) {
            $kesimpulans->whereMonth('tanggal', request('bulan'))
                ->whereYear('tanggal', request('tahun'));
        }

        $kesimpulans->orderBy('created_at', 'desc');

        return DataTables::of($kesimpulans)
            ->addIndexColumn()
            ->addColumn('user_name', function ($kesimpulan) {
                return $kesimpulan->user->name;
            })
            ->addColumn('action', function ($kesimpulan) use ($user, $isSuperAdmin) {
                return view('admin.partials.kesimpulan-actions', compact('kesimpulan', 'user', 'isSuperAdmin'))->render();
            })
            ->rawColumns(['user_name', 'action'])
            ->make(true);
    }
}
