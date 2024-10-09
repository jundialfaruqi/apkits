<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Opd;
use App\Models\User;
use App\Models\Pekerjaan;
use App\Models\Rancangan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    public function index()
    {
        $title = "Statistik";
        $user = Auth::user();
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;
        $currentMonth = Carbon::now();
        $lastMonth = $currentMonth->copy()->subMonth();

        $jobData = collect();

        if ($user->hasRole('super-admin')) {
            $opds = Opd::all();
        } else {
            $opds = collect([$user->opd]);
        }

        // Ambil semua jenis pekerjaan yang ada
        $jobs = Pekerjaan::pluck('nama_pekerjaan')->unique();

        foreach ($jobs as $job) {
            $jobUsers = collect();
            foreach ($opds as $opd) {
                $jobUsers = $jobUsers->concat($this->getUsersByJobAndOpd($job, $opd->id));
            }
            $jobData[$job] = $this->processUserData($jobUsers, $currentYear, $lastYear, $currentMonth->month, $lastMonth->month);
        }

        // Tambahkan nama bulan ke data yang dikirim ke view
        $currentMonthName = $currentMonth->locale('id')->monthName;
        $lastMonthName = $lastMonth->locale('id')->monthName;

        $chartData = $this->prepareChartData($jobData);

        return view('admin.statistik.index', compact('title', 'chartData', 'jobs', 'currentYear', 'lastYear', 'currentMonthName', 'lastMonthName'));
    }

    public function getJobData($job)
    {
        $user = Auth::user();
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        if ($user->hasRole('super-admin')) {
            $opds = Opd::all();
        } else {
            $opds = collect([$user->opd]);
        }

        $jobData = collect();
        foreach ($opds as $opd) {
            $jobUsers = $this->getUsersByJobAndOpd($job, $opd->id);
            $jobData = $jobData->concat($this->processUserData($jobUsers, $currentYear, $lastYear, $currentMonth, $lastMonth));
        }

        return DataTables::of($jobData)
            ->addIndexColumn()
            ->make(true);
    }

    private function getUsersByJobAndOpd($jobName, $opdId)
    {
        return User::with(['opd', 'formatlaporan.pekerjaanRelasi', 'profilePhoto'])
            ->whereHas('formatlaporan.pekerjaanRelasi', function ($query) use ($jobName) {
                $query->where('nama_pekerjaan', $jobName);
            })
            ->where('opd_id', $opdId)
            ->get();
    }

    private function processUserData($users, $currentYear, $lastYear, $currentMonth, $lastMonth)
    {
        return $users->map(function ($user) use ($currentYear, $lastYear, $currentMonth, $lastMonth) {
            return [
                'name' => $user->name,
                'opd' => $user->opd->name,
                'profile_photo' => $user->profilePhoto ? asset('storage/' . $user->profilePhoto->photo_path) : null,
                'currentMonthRancangan' => $this->getRancanganCount($user, $currentYear, $currentMonth),
                'lastMonthRancangan' => $this->getRancanganCount($user, $currentYear, $lastMonth),
                'currentYearRancangan' => $this->getRancanganCount($user, $currentYear),
                'lastYearRancangan' => $this->getRancanganCount($user, $lastYear),
                'totalRancangan' => $this->getTotalRancanganCount($user),
            ];
        });
    }

    private function getRancanganCount($user, $year, $month = null)
    {
        $query = Rancangan::where('user_id', $user->id)
            ->whereYear('tanggal', $year);

        if ($month) {
            $query->whereMonth('tanggal', $month);
        }

        return $query->count();
    }

    private function getTotalRancanganCount($user)
    {
        return Rancangan::where('user_id', $user->id)->count();
    }

    private function prepareChartData($jobData)
    {
        $chartData = [];
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;

        foreach ($jobData as $job => $userData) {
            $chartData[$job] = [
                'categories' => [],
                'series' => [
                    [
                        'name' => $lastYear,
                        'data' => []
                    ],
                    [
                        'name' => $currentYear,
                        'data' => []
                    ]
                ]
            ];

            foreach ($userData as $data) {
                $chartData[$job]['categories'][] = $data['name'];
                $chartData[$job]['series'][0]['data'][] = $data['lastYearRancangan'];
                $chartData[$job]['series'][1]['data'][] = $data['currentYearRancangan'];
            }
        }

        return $chartData;
    }
}
