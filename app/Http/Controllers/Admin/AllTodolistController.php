<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opd;
use App\Models\User;
use App\Models\Rancangan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class AllTodolistController extends Controller
{
    public function index()
    {
        $title = "Semua Data Todolist";
        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('super-admin');
        $isAdmin = $user->hasRole('admin');

        // Fetch all OPDs for the filter
        $opds = Opd::all();

        if (request()->ajax()) {
            $rancangans = Rancangan::with(['user.roles', 'kegiatan', 'user.opd'])
                ->select('rancangans.*');

            // Apply OPD filter if selected
            if (request()->has('opd_id') && request('opd_id') != '') {
                $rancangans->whereHas('user', function ($query) {
                    $query->where('opd_id', request('opd_id'));
                });
            } elseif ($isAdmin) {
                // If admin, show only their OPD's data
                $rancangans->whereHas('user', function ($query) use ($user) {
                    $query->where('opd_id', $user->opd_id);
                });
            }
            // Note: For super-admin, we don't apply any additional filter

            $rancangans->orderBy('rancangans.created_at', 'desc');

            return DataTables::of($rancangans)
                ->addIndexColumn()
                ->addColumn('user_name', function ($rancangan) {
                    return $rancangan->user->name;
                })
                ->addColumn('kegiatan_nama', function ($rancangan) {
                    return $rancangan->kegiatan->nama_kegiatan;
                })
                ->addColumn('user_roles', function ($rancangan) {
                    return $rancangan->user->roles->pluck('name')->map(function ($role) {
                        return '<label class="badge bg-primary text-white my-1 mx-1">' . $role . '</label>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($rancangan) use ($isSuperAdmin) {
                    if (!$isSuperAdmin) return ''; // Return empty string if not super-admin

                    $editUrl = route('todolist.edit', $rancangan->id);
                    $deleteUrl = route('todolist.delete', $rancangan->id);
                    $actions = '';
                    $actions .= '<a href="' . $editUrl . '" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>';
                    $actions .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</button>'
                        . '</form>';
                    return $actions;
                })
                ->editColumn('progress', function ($rancangan) {
                    return $rancangan->progress . '%';
                })
                ->rawColumns(['user_roles', 'action'])
                ->make(true);
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
