<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KegiatanController extends Controller
{

    public function index()
    {
        $title = "Kegiatan";
        if (request()->ajax()) {
            $kegiatan = DB::table('kegiatans')->select('id', 'nama_kegiatan');
            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('admin/kegiatan/' . $row->id . '/edit');
                    $deleteUrl = url('admin/kegiatan/' . $row->id . '/delete');

                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm rounded-pill my-1 px-2">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm rounded-pill px-2" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Delete</button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kegiatan.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah Kegiatan Baru";
        return view('admin.kegiatan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kegiatan' => 'required|string|unique:kegiatans,nama_kegiatan|max:255|min:10',
            ],
            [
                'nama_kegiatan.unique' => 'Kegiatan ini sudah ada',
                'nama_kegiatan.required' => 'Kegiatan harus diisi',
                'nama_kegiatan.min' => 'Kegiatan minimal 10 karakter',
                'nama_kegiatan.max' => 'Kegiatan maksimal 255 karakter',
            ]
        );

        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'created_at' => now(),
        ]);
        return redirect('admin/kegiatan')->with('success', 'Kegiaatan Baru berhasil ditambahkan');
    }

    public function edit($kegiatanId)
    {
        $title = "Edit Kegiatan";
        $kegiatan = Kegiatan::find($kegiatanId);
        return view('admin.kegiatan.edit', compact('title', 'kegiatan'));
    }

    public function update(Request $request, $kegiatanId)
    {
        $kegiatan = Kegiatan::find($kegiatanId);

        $request->validate(
            [
                'nama_kegiatan' => 'required|string|max:255|min:10',
            ],
            [
                'nama_kegiatan.required' => 'Kegiatan harus diisi',
                'nama_kegiatan.min' => 'Kegiatan minimal 10 karakter',
                'nama_kegiatan.max' => 'Kegiatan maksimal 255 karakter',
            ]
        );

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'updated_at' => now(),
        ]);
        return redirect('admin/kegiatan')->with('success', 'Kegiatan berhasil diperbaharui');
    }

    public function destroy($kegiatanId)
    {
        $kegiatan = Kegiatan::find($kegiatanId);
        $kegiatan->delete();
        return redirect('admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus');
    }
}
