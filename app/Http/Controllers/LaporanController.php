<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Opd;
use App\Models\Kegiatan;
use App\Models\Pekerjaan;
use App\Models\Rancangan;
use App\Models\Kesimpulan;
use Illuminate\Http\Request;
use App\Models\Formatlaporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {

        $title = "Rekap Laporan Bulanan";
        $user = auth()->user();
        $isITSupportOrTHL = $user->hasRole(['it-support', 'thl', 'super-admin']);

        if (request()->ajax()) {
            $rancangans = Rancangan::with(['user.roles', 'kegiatan'])
                ->select('rancangans.*');

            // Filter data berdasarkan user yang login jika rolenya it-support atau thl
            if ($isITSupportOrTHL) {
                $rancangans->where('user_id', $user->id);
            }

            // Filter berdasarkan bulan dan tahun
            if (request()->has('bulan') && request()->has('tahun')) {
                $rancangans->whereMonth('tanggal', request('bulan'))
                    ->whereYear('tanggal', request('tahun'));
            }

            // Filter berdasarkan kegiatan
            if (request()->has('kegiatan')) {
                $rancangans->where('kegiatan_id', request('kegiatan'));
            }

            $rancangans->orderBy('created_at', 'desc');

            return DataTables::of($rancangans)
                ->addIndexColumn()
                ->addColumn('kegiatan_nama', function ($rancangan) {
                    return $rancangan->kegiatan->nama_kegiatan;
                })
                ->addColumn('action', function ($rancangan) use ($isITSupportOrTHL, $user) {
                    $editUrl = route('todolist.edit', $rancangan->id);
                    $deleteUrl = route('todolist.delete', $rancangan->id);
                    $actions = '';
                    if ($isITSupportOrTHL && $rancangan->user_id == $user->id) {
                        $actions .= '<a href="' . $editUrl . '" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>';
                        $actions .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">'
                            . csrf_field()
                            . method_field('DELETE')
                            . '<button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</button>'
                            . '</form>';
                    }
                    return $actions;
                })
                ->editColumn('progress', function ($rancangan) {
                    return $rancangan->progress . '%';
                })
                ->rawColumns(['user_roles', 'action'])
                ->make(true);
        }

        // Jika bukan it-support atau thl, redirect atau tampilkan pesan error
        if (!$isITSupportOrTHL) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kegiatans = Kegiatan::all(); // Ambil semua kegiatan untuk dropdown
        return view('todolist.laporan.index', compact('title', 'kegiatans'));
    }

    public function exportPdf(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'bulan' => 'required|integer|between:1,12',
                'tahun' => 'required|integer|digits:4',
            ]

        );

        $bulan = (int)$request->input('bulan');
        $tahun = $request->input('tahun');

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Mengambil format laporan, OPD dan pekerjaan dari database
        $formatLaporan = FormatLaporan::where('id', $user->formatlaporan_id)->first();
        $pekerjaan = Pekerjaan::where('id', $formatLaporan->pekerjaan_id)->first();
        $opd = Opd::where('id', $user->opd_id)->first();
        $kesimpulan = Kesimpulan::where('user_id', $user->id)->get();
        $lampirans = Rancangan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('user_id', $user->id)
            ->orderBy('tanggal')
            ->get();

        // Menyiapkan query untuk data rancangan
        $query = Rancangan::with('kegiatan')
            ->where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('kegiatan_id')
            ->orderBy('tanggal');

        $rancangans = $query->get();
        $groupedRancangans = $rancangans->groupBy('kegiatan_id');
        $bulanNama = Carbon::create()->month($bulan)->format('F');

        // Mengambil kesimpulan dari tabel kesimpulans berdasarkan bulan dan tahun
        $kesimpulan = Kesimpulan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('user_id', $user->id)
            ->get();

        // Mengambil path logo dari tabel format_laporans
        $logoPath = $formatLaporan->logo_dinas
            ? public_path('assets/images/' . $formatLaporan->logo_dinas)
            : null;

        // Memeriksa apakah ada foto dalam data rancangan
        $hasPhotos = $rancangans->whereNotNull('foto')->isNotEmpty();

        // Fungsi untuk membagi teks menjadi beberapa baris
        function splitTextCustom($text)
        {
            $words = explode(' ', $text);
            $totalWords = count($words);

            // Inisialisasi variabel untuk melacak posisi kata dalam array
            $currentIndex = 0;
            $lines = [];

            // Fungsi untuk mengekstrak potongan kata dan menggeser indeks saat ini
            function extractChunk(&$words, &$currentIndex, $length)
            {
                $chunk = array_slice($words, $currentIndex, $length);
                $currentIndex += $length;
                return implode(' ', $chunk);
            }

            // Mengambil setiap baris sesuai dengan jumlah kata yang ditentukan
            if ($totalWords > 0) {
                $lines[] = extractChunk($words, $currentIndex, 2); // Baris 1: 2 kata
            }
            if ($currentIndex < $totalWords) {
                $lines[] = extractChunk($words, $currentIndex, 5); // Baris 2: 5 kata
            }
            if ($currentIndex < $totalWords) {
                $lines[] = extractChunk($words, $currentIndex, 5); // Baris 3: 5 kata
            }
            if ($currentIndex < $totalWords) {
                $lines[] = extractChunk($words, $currentIndex, $totalWords - $currentIndex); // Baris 4: Sisa kata
            }

            // Gabungkan baris dengan <br> untuk pemisah baris
            return implode('<br>', $lines);
        }

        // Contoh penggunaan fungsi splitTextCustom
        $formatLaporan->bidangFormatted = splitTextCustom($formatLaporan->bidang);

        // Generate PDF
        $pdf = PDF::loadView('todolist.laporan.pdf', compact(
            'groupedRancangans',
            'bulan',
            'bulanNama',
            'tahun',
            'user',
            'formatLaporan',
            'opd',
            'kesimpulan',
            'logoPath',
            'hasPhotos',
            'lampirans',
            'pekerjaan'
        ));

        // Stream PDF ke browser
        return $pdf->stream('laporan_pekerjaan.pdf');
    }
}
