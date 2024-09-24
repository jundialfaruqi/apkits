<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
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
        $today = Carbon::today();
        $mounth = Carbon::now()->format('m');

        // Check if the user has permission to view the dashboard
        $hasPermission = $user->hasPermissionTo('view dashboard');

        if ($user->hasRole('super-admin')) {
            // Hitung user THL
            $thlCount = User::whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                $query->where('nama_pekerjaan', 'THL');
            })->count();

            // Hitung user IT Support
            $itCount = User::whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                $query->where('nama_pekerjaan', 'IT Support');
            })->count();

            // Ambil daftar user THL
            $thlUsers = User::with(['opd', 'formatlaporan.pekerjaanRelasi'])
                ->whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                    $query->where('nama_pekerjaan', 'THL');
                })->get();

            // Hitung total rancangans untuk semua user, hanya untuk hari ini
            $totalRancangansToday = Rancangan::whereDate('tanggal', $today)->count();

            // Hitung total rancangans untuk semua user, hanya untuk bulan ini
            $totalRancangansMounth = Rancangan::whereMonth('tanggal', $mounth)->count();

            // Hitung total rancangans
            $totalRancangans = Rancangan::count();
        } else {
            // Hitung user THL di OPD yang sama
            $thlCount = User::whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                $query->where('nama_pekerjaan', 'THL');
            })
                ->where('opd_id', $user->opd_id)
                ->count();

            // Hitung user IT Support di OPD yang sama
            $itCount = User::whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                $query->where('nama_pekerjaan', 'IT Support');
            })
                ->where('opd_id', $user->opd_id)
                ->count();

            // Ambil daftar user THL di OPD yang sama
            $thlUsers = User::with(['opd', 'formatlaporan.pekerjaanRelasi'])
                ->whereHas('formatlaporan.pekerjaanRelasi', function ($query) {
                    $query->where('nama_pekerjaan', 'THL');
                })
                ->where('opd_id', $user->opd_id)
                ->get();

            // Hitung total rancangans untuk semua user di OPD yang sama, hanya untuk hari ini
            $totalRancangansToday = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })
                ->whereDate('tanggal', $today)
                ->count();

            // Hitung total rancangans untuk semua user di OPD yang sama, hanya untuk bulan ini
            $totalRancangansMounth = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })
                ->whereMonth('tanggal', $mounth)
                ->count();

            // Hitung total rancangans untuk semua user di OPD yang sama
            $totalRancangans = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })->count();
        }

        // Query data even if the user doesn't have the permission
        $query = Rancangan::with(['user:id,name,opd_id', 'user.opd:id,name'])
            // ->whereDate('tanggal', Carbon::today())
            ->whereMonth('tanggal', $mounth)
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
        return view('admin.dashboard', compact('title', 'rancangans', 'hasPermission', 'thlCount', 'thlUsers', 'itCount', 'totalRancangans', 'totalRancangansToday', 'totalRancangansMounth'));
    }
}
