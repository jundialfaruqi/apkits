<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Opd;
use App\Models\User;
use App\Models\Rancangan;
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
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        if ($user->hasRole('super-admin')) {
            $opds = Opd::all();
        } else {
            $opds = collect([$user->opd]);
        }

        $itSupportData = collect();
        $thlData = collect();

        foreach ($opds as $opd) {
            $itSupportUsers = $this->getUsersByJobAndOpd('IT Support', $opd->id);
            $thlUsers = $this->getUsersByJobAndOpd('THL', $opd->id);

            $itSupportData = $itSupportData->concat($this->processUserData($itSupportUsers, $currentYear, $lastYear, $currentMonth, $lastMonth));
            $thlData = $thlData->concat($this->processUserData($thlUsers, $currentYear, $lastYear, $currentMonth, $lastMonth));
        }

        $itSupportChartData = $this->prepareChartData($itSupportData);
        $thlChartData = $this->prepareChartData($thlData);

        return view('admin.statistik.index', compact('title', 'itSupportData', 'thlData', 'itSupportChartData', 'thlChartData', 'currentYear', 'lastYear'));
    }

    private function getUsersByJobAndOpd($jobName, $opdId)
    {
        return User::with(['opd', 'formatlaporan.pekerjaanRelasi'])
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
                'lastMonthRancangan' => $this->getRancanganCount($user, $currentYear, $lastMonth),
                'currentMonthRancangan' => $this->getRancanganCount($user, $currentYear, $currentMonth),
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

    private function prepareChartData($userData)
    {
        $chartData = [
            'categories' => [],
            'series' => [
                [
                    'name' => 'Tahun Ini',
                    'data' => []
                ],
                [
                    'name' => 'Tahun Lalu',
                    'data' => []
                ]
            ]
        ];

        foreach ($userData as $data) {
            $chartData['categories'][] = $data['name'];
            $chartData['series'][0]['data'][] = $data['currentYearRancangan'];
            $chartData['series'][1]['data'][] = $data['lastYearRancangan'];
        }

        return $chartData;
    }
}
