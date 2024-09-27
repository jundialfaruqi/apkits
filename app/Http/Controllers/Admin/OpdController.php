<?php

namespace App\Http\Controllers\Admin;

use App\Models\Opd;
use App\Services\OpdService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OpdController extends Controller
{

    protected $opdService;
    public function __construct(OpdService $opdService)
    {
        $this->opdService = $opdService;
    }

    public function index()
    {
        $title = "Data OPD";

        if (request()->ajax()) {
            return $this->opdService->getDatatables();
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
