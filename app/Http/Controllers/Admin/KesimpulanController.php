<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kesimpulan;
use Illuminate\Http\Request;
use App\Services\KesimpulanService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class KesimpulanController extends Controller
{
    protected $kesimpulanService;

    public function __construct(KesimpulanService $kesimpulanService)
    {
        $this->kesimpulanService = $kesimpulanService;
    }

    public function index()
    {
        $title = 'Kesimpulan';
        $user = Auth::user();
        $canViewAll = $user->hasPermissionTo('view all kesimpulan');
        $canView = $user->hasPermissionTo('view kesimpulan');
        $isSuperAdmin = $user->hasRole('super-admin');

        if (!$canViewAll && !$canView && !$isSuperAdmin) {
            abort(403, 'Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        if (request()->ajax()) {
            return $this->kesimpulanService->getDatatables($user, $canViewAll, $canView, $isSuperAdmin);
        }

        return view('admin.kesimpulan.index', compact('title'));
    }

    public function create()
    {
        $title = 'Buat Kesimpulan Baru';
        return view('admin.kesimpulan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'isi_kesimpulan' =>  'required|string|min:3|max:255',
                'tanggal' => 'required|date',
            ],
            [
                'isi_kesimpulan.required' => 'Isi kesimpulan wajib diisi',
                'isi_kesimpulan.min' => 'Isi kesimpulan minimal 3 karakter',
                'isi_kesimpulan.max' => 'Isi kesimpulan maksimal 255 karakter',
                'tanggal.required' => 'Tanggal wajib diisi',
            ]
        );

        $kesimpulan = new Kesimpulan();
        $kesimpulan->isi_kesimpulan = $request->isi_kesimpulan;
        $kesimpulan->tanggal = $request->tanggal;
        $kesimpulan->user_id = auth()->user()->id;
        $kesimpulan->save();
        return redirect('laporan/kesimpulan')->with('success', 'Data kesimpulan berhasil ditambahkan');
    }

    public function edit($kesimpulanId)
    {
        $title = 'Edit Kesimpulan Laporan';
        $kesimpulan = Kesimpulan::findOrFail($kesimpulanId);
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            // Super-admin dapat mengedit semua data
            return view('admin.kesimpulan.edit', compact('title', 'kesimpulan'));
        } elseif ($user->hasPermissionTo('edit kesimpulan')) {
            if ($user->hasRole('admin')) {
                // Admin hanya bisa mengedit data dengan opd_id yang sama
                if ($kesimpulan->opd_id === $user->opd_id) {
                    return view('admin.kesimpulan.edit', compact('title', 'kesimpulan'));
                } else {
                    abort(403, 'Anda tidak memiliki izin untuk mengedit kesimpulan ini.');
                }
            } else {
                // User biasa hanya bisa mengedit data miliknya sendiri
                if ($kesimpulan->user_id === $user->id) {
                    return view('admin.kesimpulan.edit', compact('title', 'kesimpulan'));
                } else {
                    abort(403, 'Anda tidak memiliki izin untuk mengedit kesimpulan ini.');
                }
            }
        } else {
            abort(403, 'Anda tidak memiliki izin untuk mengedit kesimpulan.');
        }
    }

    public function update(Request $request, $kesimpulanId)
    {
        $kesimpulan = Kesimpulan::findOrFail($kesimpulanId);
        $user = auth()->user();

        if (
            $user->hasRole('super-admin') ||
            ($user->hasPermissionTo('edit kesimpulan') &&
                (($user->hasRole('admin') && $kesimpulan->opd_id === $user->opd_id) ||
                    $kesimpulan->user_id === $user->id))
        ) {

            $request->validate(
                [
                    'isi_kesimpulan' =>  'required|string|min:3|max:255',
                    'tanggal' => 'required|date',
                ],
                [
                    'isi_kesimpulan.required' => 'Isi kesimpulan wajib diisi',
                    'isi_kesimpulan.min' => 'Isi kesimpulan minimal 3 karakter',
                    'isi_kesimpulan.max' => 'Isi kesimpulan maksimal 255 karakter',
                    'tanggal.required' => 'Tanggal wajib diisi',
                ]
            );

            $kesimpulan->isi_kesimpulan = $request->isi_kesimpulan;
            $kesimpulan->tanggal = $request->tanggal;
            $kesimpulan->save();

            return redirect('laporan/kesimpulan')->with('success', 'Data kesimpulan berhasil diperbarui');
        } else {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
        }
    }

    public function destroy($kesimpulanId)
    {
        $kesimpulan = Kesimpulan::findOrFail($kesimpulanId);
        $user = auth()->user();

        if (
            $user->hasRole('super-admin') ||
            ($user->hasPermissionTo('delete kesimpulan') &&
                (($user->hasRole('admin') && $kesimpulan->opd_id === $user->opd_id) ||
                    $kesimpulan->user_id === $user->id))
        ) {

            $kesimpulan->delete();
            return redirect('laporan/kesimpulan')->with('success', 'Data kesimpulan berhasil dihapus');
        } else {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }
    }
}
