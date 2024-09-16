<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Opd;

class OpdController extends Controller
{
    public function index()
    {
        $title = "Data OPD Pekanbaru";

        if (request()->ajax()) {
            $opds = DB::table('opds')->select('id', 'name');
            return DataTables::of($opds)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('admin/opd/' . $row->id . '/edit');
                    $deleteUrl = url('admin/opd/' . $row->id . '/delete');

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

        return view('admin.opd.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah OPD Baru";
        return view('admin.opd.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:opds',
            ],
            [
                'name.unique' => 'OPD sudah ada',
                'name.required' => 'OPD harus diisi',
            ]
        );
        $opd = new Opd;
        $opd->name = $request->name;
        $opd->save();

        return redirect('admin/opd')->with('success', 'OPD Baru berhasil ditambahkan');
    }

    public function edit($opdId)
    {
        $title = "Ubah Data OPD";
        $opd = Opd::find($opdId);
        return view('admin.opd.edit', compact('title', 'opd'));
    }

    public function update(Request $request, string $id)
    {
        $opd = Opd::findOrFail($id);
        $request->validate(
            [
                'name' => 'required|unique:opds,name,',
            ],
            [
                'name.unique' => 'OPD sudah ada',
                'name.required' => 'OPD harus diisi',
            ]
        );

        // Update Data

        $opd->name = $request->name;
        $opd->save();
        return redirect()->route('opd.index')
            ->with('success', 'Data Todolist berhasil diupdate');
    }

    public function destroy($opdId)
    {
        $opd = Opd::find($opdId);
        $opd->delete();
        // beralih ke halaman itrequest dan tampilkan pesan sukses
        return redirect()->route('opd.index')
            ->with('success', 'Data OPD berhasil dihapus');
    }
}
