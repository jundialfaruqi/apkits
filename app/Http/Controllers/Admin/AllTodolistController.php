<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opd;
use App\Models\User;
use App\Models\Rancangan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\RancanganService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class AllTodolistController extends Controller
{
    protected $rancanganService;

    public function __construct(RancanganService $rancanganService)
    {
        $this->rancanganService = $rancanganService;
    }

    public function index()
    {
        $title = "Semua Data Todolist";
        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('super-admin');
        $isAdmin = $user->hasRole('admin');
        $opds = Opd::all();

        if (request()->ajax()) {
            return $this->rancanganService->getDatatables($user, $isSuperAdmin, $isAdmin);
        }

        return view('admin/rancangan/index', compact('title', 'isSuperAdmin', 'isAdmin', 'opds'));
    }

    public function create()
    {
        $title = "Tambah Rancangan";
        return view('todolist/create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'kegiatan_id' => 'required|exists:kegiatans,id',
                'jenis_kegiatan' => 'required|string',
                'tanggal' => 'required|date',
                'tempat' => 'required|string',
                'pelaksanaan_kerja' => 'required|string',
                'progress' => 'required|integer|min:0|max:100',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'kegiatan_id.exists' => 'Kegiatan tidak terdaftar',
                'foto.image' => 'File harus berupa gambar',
                'foto.max' => 'File terlalu besar',
                'foto.mimes' => 'File harus berupa jpeg, png, jpg, atau gif',
            ]
        );

        $rancangan = new Rancangan($validatedData);
        $rancangan->user_id = Auth::id();

        // Periksa jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $image = Image::read($request->file('foto'));
            $image->scale(800, 450, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Simpan gambar yang telah di-resize ke direktori storage dan dapatkan path-nya
            $storedPath = 'rancangan/' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $image->save(public_path('assets/images/' . $storedPath));
            // Simpan data rancangan ke database
            $rancangan->foto = $storedPath;
        } else {
            // Jika field foto kosong, input null ke database
            $rancangan->foto = null;
        }

        $rancangan->save(); // Simpan instance $rancangan ke database

        // beralih ke halaman rancangan dan tampilkan pesan sukses
        return redirect()->route('rancangan')
            ->with('success', 'Rancangan berhasil ditambahkan');
    }
}
