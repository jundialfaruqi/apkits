<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opd;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use App\Models\Formatlaporan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class FormatLaporanController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if (!$user->hasRole(['super-admin', 'admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini');
        }
        $title = 'Format Laporan';
        $isSuperAdmin = $user->hasRole('super-admin');

        if (request()->ajax()) {
            $formatlaporans = Formatlaporan::select(
                'formatlaporans.*',
                'opds.name as opd_name',
                'pekerjaans.nama_pekerjaan as pekerjaan_name'
            )
                ->leftJoin('opds', 'formatlaporans.opd_id', '=', 'opds.id')
                ->leftJoin('pekerjaans', 'formatlaporans.pekerjaan_id', '=', 'pekerjaans.id');

            if (!$isSuperAdmin) {
                $formatlaporans->where('formatlaporans.opd_id', $user->opd_id);
            }

            return DataTables::of($formatlaporans)
                ->addIndexColumn()
                ->addColumn('action', function ($formatlaporan) use ($isSuperAdmin, $user) {
                    $editUrl = route('formatlaporan.edit', $formatlaporan->id);
                    $deleteUrl = route('formatlaporan.delete', $formatlaporan->id);
                    $actions = '';
                    if ($isSuperAdmin || $user->opd_id == $formatlaporan->opd_id) {
                        $actions .= '<a href="' . $editUrl . '" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>';
                        $actions .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">'
                            . csrf_field()
                            . method_field('DELETE')
                            . '<button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</button>'
                            . '</form>';
                    }
                    return $actions;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) {
                    if (request()->has('search') && request('search')['value']) {
                        $searchValue = strtolower(request('search')['value']);
                        $query->where(function ($q) use ($searchValue) {
                            $q->where('formatlaporans.bidang', 'LIKE', "%{$searchValue}%")
                                ->orWhere('formatlaporans.pekerjaan', 'LIKE', "%{$searchValue}%")
                                ->orWhere('formatlaporans.kabid', 'LIKE', "%{$searchValue}%")
                                ->orWhere('formatlaporans.jabatan', 'LIKE', "%{$searchValue}%")
                                ->orWhere('formatlaporans.nip', 'LIKE', "%{$searchValue}%")
                                ->orWhere('opds.name', 'LIKE', "%{$searchValue}%")
                                ->orWhere('pekerjaans.nama_pekerjaan', 'LIKE', "%{$searchValue}%");
                        });
                    }
                })
                ->make(true);
        }

        return view('admin.format-laporan.index', compact('title'));
    }

    public function create()
    {
        $user = auth()->user();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $title = 'Buat Format Laporan Baru';

        if ($user->hasRole('super-admin')) {
            $opds = Opd::with('formatlaporans')->get(['id', 'name']);
        } else {
            $opds = Opd::with('formatlaporans')->where('id', $user->opd_id)->get(['id', 'name']);
        }

        $pekerjaans = Pekerjaan::with('formatlaporans')->get(['id', 'nama_pekerjaan']);

        return view('admin.format-laporan.create', compact('title', 'opds', 'pekerjaans'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $validationRules = [
            'bidang' => 'required|string',
            'pekerjaan' => 'nullable',
            'kabid' => 'required|string',
            'jabatan' => 'required|string',
            'nip' => 'required|string',
            'latar_belakang' => 'required|string',
            'maksud_tujuan' => 'required|string',
            'ruang_lingkup' => 'required|string',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'logo_dinas' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validationMessages = [
            'bidang.required' => 'Bidang wajib diisi',
            'kabid.required' => 'Kepala Bidang wajib diisi',
            'jabatan.required' => 'Nama jabatan wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'latar_belakang.required' => 'Latar Belakang wajib diisi',
            'maksud_tujuan.required' => 'Maksud Tujuan wajib diisi',
            'ruang_lingkup.required' => 'Ruang Lingkup wajib diisi',
            'pekerjaan_id.exists' => 'Pekerjaan tidak terdaftar',
            'pekerjaan_id.required' => 'Pekerjaan wajib diisi',
            'logo_dinas.required' => 'Logo Dinas wajib diisi',
            'logo_dinas.image' => 'File harus berupa gambar',
            'logo_dinas.max' => 'File terlalu besar',
            'logo_dinas.mimes' => 'File harus berupa jpeg, png, jpg, atau gif',
        ];

        if ($user->hasRole('super-admin')) {
            $validationRules['opd_id'] = 'required|exists:opds,id';
            $validationMessages['opd_id.required'] = 'OPD wajib diisi';
            $validationMessages['opd_id.exists'] = 'OPD tidak terdaftar';
        } else {
            $request->merge(['opd_id' => $user->opd_id]);
        }

        $validatedData = $request->validate($validationRules, $validationMessages);

        // Pastikan opd_id selalu ada dalam $validatedData
        if (!isset($validatedData['opd_id'])) {
            $validatedData['opd_id'] = $user->opd_id;
        }

        $formatlaporan = new Formatlaporan($validatedData);

        if ($request->hasFile('logo_dinas')) {
            $image = Image::read($request->file('logo_dinas'));
            $image->scale(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $storedPath = 'logodinas/' . time() . '-' . $request->file('logo_dinas')->getClientOriginalName();
            $image->save(public_path('assets/images/' . $storedPath));
            $formatlaporan->logo_dinas = $storedPath;
        } else {
            $formatlaporan->logo_dinas = null;
        }

        $formatlaporan->save();

        return redirect()->route('formatlaporan.index')->with('success', 'Format Laporan baru telah ditambahkan');
    }

    public function destroy($formatlaporanId)
    {
        $formatlaporan = Formatlaporan::find($formatlaporanId);

        // Hapus file foto dari storage jika ada
        if ($formatlaporan->logo_dinas) {
            $filePath = public_path('assets/images/' . $formatlaporan->logo_dinas);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        // Hapus data itrequest dari database
        $formatlaporan->delete();

        // beralih ke halaman itrequest dan tampilkan pesan sukses
        return redirect()->route('formatlaporan.index')
            ->with('success', 'Data Format Laporan berhasil dihapus');
    }

    public function edit($formatlaporanId)
    {
        $user = auth()->user();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $formatlaporan = Formatlaporan::findOrFail($formatlaporanId);

        // Cek apakah admin biasa mencoba mengedit laporan yang bukan milik OPD-nya
        if (!$user->hasRole('super-admin') && $formatlaporan->opd_id !== $user->opd_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit laporan ini.');
        }

        $title = 'Edit Format Laporan';

        $data = [
            'title' => $title,
            'formatlaporan' => $formatlaporan,
            'isSuperAdmin' => $user->hasRole('super-admin')
        ];

        if ($user->hasRole('super-admin')) {
            $data['opds'] = Opd::all(['id', 'name']);
        }

        $data['pekerjaans'] = Pekerjaan::all(['id', 'nama_pekerjaan']);

        return view('admin.format-laporan.edit', $data);
    }

    public function update(Request $request, $formatlaporanId)
    {
        $user = auth()->user();

        if (!$user->hasRole(['super-admin', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $formatlaporan = Formatlaporan::findOrFail($formatlaporanId);

        // Cek apakah admin biasa mencoba mengupdate laporan yang bukan milik OPD-nya
        if (!$user->hasRole('super-admin') && $formatlaporan->opd_id !== $user->opd_id) {
            abort(403, 'You are not authorized to update this report.');
        }

        $validationRules = [
            'bidang' => 'required|string',
            'pekerjaan' => 'nullable|string',
            'kabid' => 'required|string',
            'jabatan' => 'required|string',
            'nip' => 'required|string',
            'latar_belakang' => 'required|string',
            'maksud_tujuan' => 'required|string',
            'ruang_lingkup' => 'required|string',
            'logo_dinas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
        ];

        $validationMessages = [
            'bidang.required' => 'Bidang wajib diisi',
            'kabid.required' => 'Kepala Bidang wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'latar_belakang.required' => 'Latar Belakang wajib diisi',
            'maksud_tujuan.required' => 'Maksud Tujuan wajib diisi',
            'ruang_lingkup.required' => 'Ruang Lingkup wajib diisi',
            'logo_dinas.image' => 'File harus berupa gambar',
            'logo_dinas.max' => 'File terlalu besar',
            'logo_dinas.mimes' => 'File harus berupa jpeg, png, jpg, atau gif',
            'pekerjaan_id.required' => 'Pekerjaan wajib diisi',
            'pekerjaan_id.exists' => 'Pekerjaan tidak terdaftar',
        ];

        if ($user->hasRole('super-admin')) {
            $validationRules['opd_id'] = 'required|exists:opds,id';
            $validationMessages['opd_id.required'] = 'OPD wajib diisi';
            $validationMessages['opd_id.exists'] = 'OPD tidak terdaftar';
        } else {
            $request->merge(['opd_id' => $user->opd_id]);
        }

        $validatedData = $request->validate($validationRules, $validationMessages);

        // Pastikan opd_id selalu ada dalam $validatedData
        if (!isset($validatedData['opd_id'])) {
            $validatedData['opd_id'] = $user->opd_id;
        }

        $formatlaporan->fill($validatedData);

        if ($request->hasFile('logo_dinas')) {
            // Hapus file lama jika ada
            if ($formatlaporan->logo_dinas) {
                $oldFilePath = public_path('assets/images/' . $formatlaporan->logo_dinas);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $image = Image::read($request->file('logo_dinas'));
            $image->scale(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Simpan gambar yang telah di-resize ke direktori storage dan dapatkan path-nya
            $storedPath = 'logodinas/' . time() . '.' . $request->file('logo_dinas')->getClientOriginalExtension();
            $image->save(public_path('assets/images/' . $storedPath));
            $formatlaporan->logo_dinas = $storedPath;
        }

        $formatlaporan->save();

        return redirect()->route('formatlaporan.index')->with('success', 'Data Format Laporan telah diperbarui');
    }
}
