<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Rancangan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //Menampilkan Dashboard Admin

    public function index()
    {
        $title = "Dashboard";
        app()->setLocale('id');

        $user = Auth::user();

        // Check if the user has permission to view the dashboard
        $hasPermission = $user->hasPermissionTo('view dashboard');

        // Query data even if the user doesn't have the permission
        $query = Rancangan::with(['user:id,name,opd_id', 'user.opd:id,name'])
            ->whereDate('tanggal', Carbon::today())
            ->select('id', 'user_id', 'jenis_kegiatan', 'tempat', 'pelaksanaan_kerja', 'foto', 'created_at')
            ->orderBy('created_at', 'desc');

        if ($user->hasRole('super-admin')) {
            $rancangans = $query->paginate(10);
        } else {
            $rancangans = $query->whereHas('user', function ($q) use ($user) {
                $q->where('opd_id', $user->opd_id);
            })->paginate(10);
        }

        // Pass the permission check result to the view
        return view('admin.dashboard', compact('title', 'rancangans', 'hasPermission'));
    }
}
