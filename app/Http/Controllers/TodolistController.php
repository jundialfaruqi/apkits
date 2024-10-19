<?php

namespace App\Http\Controllers;

use App\Models\Rancangan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\Permission\Exceptions\UnauthorizedException;

class TodolistController extends Controller
{

    public function index()
    {
        $title = 'Form Todolist';
        return view('todolist/index', compact('title'));
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
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            ],
            [
                'kegiatan_id.exists' => 'Kegiatan tidak terdaftar',
                'kegiatan_id.required' => 'Kegiatan wajib diisi',
                'jenis_kegiatan.required' => 'Jenis kegiatan harus diisi',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tempat.required' => 'Tempat wajib diisi',
                'pelaksanaan_kerja.required' => 'Pelaksanaan kerja wajib diisi',
                'progress.required' => 'Progress wajib diisi',
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
        return redirect()->route('dashboard')
            ->with('success', 'Todolist berhasil ditambahkan');
    }

    public function edit($todolistId)
    {
        $title = 'Edit Todolist';
        $rancangan = Rancangan::findOrFail($todolistId);

        // Memeriksa apakah pengguna memiliki izin untuk mengedit todolist
        // dan apakah todolist ini milik pengguna tersebut
        if (
            !auth()->user()->can('edit all todolists') &&
            (!auth()->user()->can('edit todolist') || $rancangan->user_id !== auth()->id())
        ) {
            throw new UnauthorizedException(403, 'Anda tidak memiliki izin untuk mengedit todolist ini.');
        }

        return view('todolist/edit', compact('title', 'rancangan'));
    }

    public function update(Request $request, string $id)
    {

        $rancangan = Rancangan::findOrFail($id);

        $request->validate(
            [
                'kegiatan_id' => 'required|exists:kegiatans,id',
                'jenis_kegiatan' => 'required|string',
                'tanggal' => 'required|date',
                'tempat' => 'required|string',
                'pelaksanaan_kerja' => 'required|string',
                'progress' => 'required|integer|min:0|max:100',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            ],
            [
                'kegiatan_id.exists' => 'Kegiatan tidak terdaftar',
                'kegiatan_id.required' => 'Kegiatan wajib diisi',
                'jenis_kegiatan.required' => 'Jenis kegiatan harus diisi',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tempat.required' => 'Tempat wajib diisi',
                'pelaksanaan_kerja.required' => 'Pelaksanaan kerja wajib diisi',
                'progress.required' => 'Progress wajib diisi',
                'foto.image' => 'File harus berupa gambar',
                'foto.max' => 'File terlalu besar',
                'foto.mimes' => 'File harus berupa jpeg, png, jpg, atau gif',
            ]
        );

        // Update data

        $rancangan->kegiatan_id = $request->kegiatan_id;
        $rancangan->jenis_kegiatan = $request->jenis_kegiatan;
        $rancangan->tanggal = $request->tanggal;
        $rancangan->tempat = $request->tempat;
        $rancangan->pelaksanaan_kerja = $request->pelaksanaan_kerja;
        $rancangan->progress = $request->progress;

        // Periksa jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus file foto lama jika ada
            if ($rancangan->foto) {
                $oldFilePath = public_path('assets/images/' . $rancangan->foto);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $image = Image::read($request->file('foto'));
            $image->scale(800, 450, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Simpan gambar yang telah di-resize ke direktori public dan dapatkan path-nya
            $storedPath = 'rancangan/' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $image->save(public_path('assets/images/' . $storedPath));
            // Simpan data rancangan ke database
            $rancangan->foto = $storedPath;
        } elseif ($rancangan->foto) {
            // Jika tidak ada file foto yang diunggah, pertahankan foto yang sudah ada
            $rancangan->foto = $rancangan->foto;
        } else {
            // Jika field foto kosong dan tidak ada foto sebelumnya, input null ke database
            $rancangan->foto = null;
        }
        // Update data rancangan lainnya jika ada
        // ...
        $rancangan->save(); // <--- Tambahkan ini untuk menyimpan data ke database
        // beralih ke halaman rancangan dan tampilkan pesan sukses
        return redirect()->route('dashboard')
            ->with('success', 'Data Todolist berhasil diupdate');
    }

    public function destroy($todolistId)
    {
        $rancangan = Rancangan::findOrFail($todolistId);

        // Cek apakah user adalah super-admin atau pemilik data
        if (auth()->user()->hasRole('super-admin') || $rancangan->user_id == auth()->id()) {
            // Hapus file foto dari storage jika ada
            if ($rancangan->foto) {
                $filePath = public_path('assets/images/' . $rancangan->foto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            // Hapus data rancangan dari database
            $rancangan->delete();

            return redirect()->route('todolist.laporan')
                ->with('success', 'Data Todolist berhasil dihapus');
        } else {
            return redirect()->route('todolist.laporan')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus data ini');
        }
    }
}
