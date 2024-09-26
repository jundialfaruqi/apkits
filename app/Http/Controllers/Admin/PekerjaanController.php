<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PekerjaanService;

class PekerjaanController extends Controller
{

    protected $pekerjaanService;

    public function __construct(PekerjaanService $pekerjaanService)
    {
        $this->pekerjaanService = $pekerjaanService;
    }

    public function index()
    {
        $title = "Data Pekerjaan";

        if (request()->ajax()) {
            return $this->pekerjaanService->getDatatables();
        }

        return view('admin.pekerjaan.index', compact('title'));
    }

    public function create()
    {
        $title = 'Buat Pekerjaan Baru';
        return view('admin.pekerjaan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pekerjaan' => 'required|string|min:3|max:255',
            ],

            [
                'nama_pekerjaan.required' => 'Pekerjaan harus diisi',
                'nama_pekerjaan.min' => 'Pekerjaan minimal 3 karakter',
                'nama_pekerjaan.max' => 'Pekerjaan maksimal 255 karakter',
            ]
        );

        $pekerjaan = new Pekerjaan();
        $pekerjaan->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaan->save();
        return redirect('admin/pekerjaan')->with('success', 'Data pekerjaan berhasil ditambahkan');
    }

    public function edit($pekerjaanId)
    {
        $pekerjaan = Pekerjaan::find($pekerjaanId);
        $title = 'Ubah Pekerjaan';
        return view('admin.pekerjaan.edit', compact('pekerjaan', 'title'));
    }

    public function update(Request $request, string $id)
    {
        $pekerjaan = Pekerjaan::find($id);

        $request->validate(
            [
                'nama_pekerjaan' => 'required|string|min:3|max:255',
            ],

            [
                'nama_pekerjaan.required' => 'Pekerjaan harus diisi',
                'nama_pekerjaan.min' => 'Pekerjaan minimal 3 karakter',
                'nama_pekerjaan.max' => 'Pekerjaan maksimal 255 karakter',
            ]
        );

        // Update Data
        $pekerjaan->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaan->save();
        return redirect('admin/pekerjaan')->with('success', 'Data pekerjaan berhasil diubah');
    }

    public function destroy($pekerjaanId)
    {
        $pekerjaan = Pekerjaan::find($pekerjaanId);
        $pekerjaan->delete();
        return redirect('admin/pekerjaan')->with('success', 'Data pekerjaan berhasil dihapus');
    }
}
