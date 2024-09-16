<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PekerjaanController extends Controller
{
    public function index()
    {
        $title = 'Pekerjaan';

        if (request()->ajax()) {
            $pekerjaan = DB::table('pekerjaans')->select('id', 'nama_pekerjaan');
            return DataTables::of($pekerjaan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('admin/pekerjaan/' . $row->id . '/edit');
                    $deleteUrl = url('admin/pekerjaan/' . $row->id . '/delete');

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
