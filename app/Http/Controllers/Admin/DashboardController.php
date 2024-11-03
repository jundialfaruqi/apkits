<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rancangan;
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
        $currentMonth = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $lastMonth = Carbon::now()->subMonth();
        $lastYear = Carbon::now()->subYear();

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
            $totalRancangansMounth = Rancangan::whereMonth('tanggal', Carbon::now()->format('m'))
                ->whereYear('tanggal', Carbon::now()->format('Y'))
                ->count();

            // Hitung total rancangans
            $totalRancangans = Rancangan::count();

            $totalRancangansLastMonth = Rancangan::whereMonth('tanggal', $lastMonth->format('m'))
                ->whereYear('tanggal', $lastMonth->format('Y'))
                ->count();

            $totalRancangansCurrentYear = Rancangan::whereYear('tanggal', $year)->count();

            $totalRancangansPreviousYear = Rancangan::whereYear('tanggal', $lastYear->format('Y'))->count();
        } elseif ($user->hasRole('admin')) {
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
                ->whereMonth('tanggal', Carbon::now()->format('m'))
                ->whereYear('tanggal', Carbon::now()->format('Y'))
                ->count();

            // Hitung total rancangans untuk semua user di OPD yang sama
            $totalRancangans = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })->count();

            $totalRancangansLastMonth = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })
                ->whereMonth('tanggal', $lastMonth->format('m'))
                ->whereYear('tanggal', $lastMonth->format('Y'))
                ->count();

            $totalRancangansCurrentYear = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })
                ->whereYear('tanggal', $year)
                ->count();

            $totalRancangansPreviousYear = Rancangan::whereHas('user', function ($query) use ($user) {
                $query->where('opd_id', $user->opd_id);
            })
                ->whereYear('tanggal', $lastYear->format('Y'))
                ->count();
        } else {
            // Regular user - only show their own data

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

            // Hitung total rancangans milik user itu sendiri, hanya untuk hari ini
            $totalRancangansToday = Rancangan::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->count();

            // Hitung total rancangans milik user itu sendiri, hanya untuk bulan ini
            $totalRancangansMounth = Rancangan::where('user_id', $user->id)
                ->whereMonth('tanggal', Carbon::now()->format('m'))
                ->whereYear('tanggal', Carbon::now()->format('Y'))
                ->count();

            // Hitung total rancangans milik user itu sendiri
            $totalRancangans = Rancangan::where('user_id', $user->id)->count();

            // For regular users, we don't need to get the THL users list
            $thlUsers = collect();

            $totalRancangansLastMonth = Rancangan::where('user_id', $user->id)
                ->whereMonth('tanggal', $lastMonth->format('m'))
                ->whereYear('tanggal', $lastMonth->format('Y'))
                ->count();

            $totalRancangansCurrentYear = Rancangan::where('user_id', $user->id)
                ->whereYear('tanggal', $year)
                ->count();

            $totalRancangansPreviousYear = Rancangan::where('user_id', $user->id)
                ->whereYear('tanggal', $lastYear->format('Y'))
                ->count();
        }

        // Query data even if the user doesn't have the permission
        $query = Rancangan::with(['user:id,name,opd_id', 'user.opd:id,name'])
            ->select('id', 'user_id', 'jenis_kegiatan', 'tempat', 'pelaksanaan_kerja', 'foto', 'created_at', 'tanggal');

        // Apply date filter
        $filter = request('filter', 'Bulan Ini');

        switch ($filter) {
            case 'Hari Ini':
                $query->whereDate('tanggal', Carbon::today());
                break;

            case 'Kemarin':
                $query->whereDate('tanggal', Carbon::yesterday());
                break;

            case '7 Hari Terakhir':
                $query->whereBetween('tanggal', [Carbon::now()->subDays(7), Carbon::now()]);
                break;

            case 'Bulan Ini':
                $query->whereMonth('tanggal', Carbon::now()->format('m'))
                    ->whereYear('tanggal', Carbon::now()->format('Y'));
                break;

            case 'Bulan Lalu':
                $query->whereMonth('tanggal', Carbon::now()->subMonth()->format('m'))
                    ->whereYear('tanggal', Carbon::now()->subMonth()->format('Y'));
                break;

            case '30 Hari Terakhir':
                $query->whereBetween('tanggal', [Carbon::now()->subDays(30), Carbon::now()]);
                break;
        }

        $query->orderBy('tanggal', 'desc');

        // Apply role-based filtering
        if ($user->hasRole('super-admin')) {
            $rancangans = $query->paginate(10);
        } else {
            $rancangans = $query->whereHas('user', function ($q) use ($user) {
                $q->where('opd_id', $user->opd_id);
            })->paginate(10);
        }

        return view('admin.dashboard', compact(
            'title',
            'rancangans',
            'hasPermission',
            'thlCount',
            'thlUsers',
            'itCount',
            'totalRancangans',
            'totalRancangansToday',
            'totalRancangansMounth',
            'totalRancangansLastMonth',
            'totalRancangansCurrentYear',
            'totalRancangansPreviousYear'
        ));
    }

    public function show($id)
    {
        $rancangan = Rancangan::findOrFail($id);
        return response()->json($rancangan);
    }
}
