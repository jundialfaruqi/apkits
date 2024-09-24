<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\User;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use App\Models\Formatlaporan;
use App\Services\UserService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $title = "Data User";
        $isSuperAdmin = Auth::user()->hasRole('super-admin');
        $users = $this->userService->getUsersQuery();

        if (request()->ajax()) {
            return $this->userService->getDatatables($users);
        }

        return view('role-permission.user.index', compact('title', 'users', 'isSuperAdmin'));
    }

    public function create()
    {
        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('super-admin');

        if ($isSuperAdmin) {
            $roles = Role::pluck('name', 'name')->all();
            $opds = Opd::with('formatlaporans.pekerjaanRelasi')->get(['id', 'name']);
        } else {
            $allowedRoles = ['it-support', 'thl', 'kadis', 'kabid', 'kaban', 'sekretaris', 'kasum', 'kabag', 'kasubag'];
            $roles = Role::whereIn('name', $allowedRoles)->pluck('name', 'name')->all();
            $opds = Opd::with('formatlaporans.pekerjaanRelasi')->where('id', $user->opd_id)->get(['id', 'name']);
        }

        // Ambil semua pekerjaan
        $pekerjaans = Pekerjaan::pluck('nama_pekerjaan', 'id')->all();

        $title = "Tambah User Baru";

        return view('role-permission.user.create', [
            'title' => $title,
            'roles' => $roles,
            'opds' => $opds,
            'pekerjaans' => $pekerjaans,
            'isSuperAdmin' => $isSuperAdmin
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('super-admin');
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'roles' => 'required|array',
                'roles.*' => 'exists:roles,name',
                'opd_id' => 'required|exists:opds,id',
                'bidang' => 'required|string|max:255',
                'pekerjaan_id' => 'required|exists:pekerjaans,id', // Tambahkan validasi untuk pekerjaan_id
            ],
            [
                'name.required' => 'Kolom nama harus diisi',
                'email.required' => 'Kolom email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Kolom password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'roles.required' => 'Kolom role harus diisi',
                'opd_id.required' => 'Pilih OPD',
                'bidang.required' => 'Pilih Bidang',
                'roles.*.exists' => 'Role tidak ditemukan',
                'opd_id.exists' => 'OPD tidak ditemukan',
                'bidang.exists' => 'Bidang tidak ditemukan',
                'pekerjaan_id.required' => 'Pilih Pekerjaan', // Tambahkan pesan error untuk pekerjaan_id
                'pekerjaan_id.exists' => 'Pekerjaan tidak ditemukan', // Tambahkan pesan error untuk pekerjaan_id
            ]
        );

        // Validasi tambahan untuk non-super-admin
        if (!$isSuperAdmin) {
            if ($validatedData['opd_id'] != $user->opd_id) {
                return redirect()->back()->withInput()->withErrors(['opd_id' => 'Anda hanya bisa membuat user untuk OPD Anda sendiri.']);
            }
            $allowedRoles = ['it-support', 'thl', 'kadis', 'kabid', 'kaban', 'sekretaris', 'kasum', 'kabag', 'kasubag'];
            if (array_diff($validatedData['roles'], $allowedRoles)) {
                return redirect()->back()->withInput()->withErrors(['roles' => 'Anda tidak memiliki izin untuk memberikan role tersebut.']);
            }
        }

        // Cari formatlaporan berdasarkan opd_id, bidang, dan pekerjaan_id
        $formatlaporan = Formatlaporan::where('opd_id', $validatedData['opd_id'])
            ->where('bidang', $validatedData['bidang'])
            ->where('pekerjaan_id', $validatedData['pekerjaan_id']) // Tambahkan kondisi untuk pekerjaan_id
            ->first();

        if (!$formatlaporan) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Kombinasi OPD, bidang, dan pekerjaan tidak valid.']);
        }

        $newUser = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'opd_id' => $validatedData['opd_id'],
            'formatlaporan_id' => $formatlaporan->id
        ]);

        $newUser->syncRoles($validatedData['roles']);

        return redirect('admin/users')->with('success', 'User created successfully with role');
    }

    public function edit(User $user)
    {
        $currentUser = auth()->user();
        $isSuperAdmin = $currentUser->hasRole('super-admin');

        // Jika bukan super-admin, pastikan hanya bisa edit user dari OPD yang sama
        if (!$isSuperAdmin && $currentUser->opd_id !== $user->opd_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit user ini.');
        }

        if ($isSuperAdmin) {
            $roles = Role::pluck('name', 'name')->all();
            $opds = Opd::with('formatlaporans.pekerjaanRelasi')->get();
        } else {
            $allowedRoles = ['it-support', 'thl', 'kadis', 'kabid', 'kaban', 'sekretaris', 'kasum', 'kabag', 'kasubag'];
            $roles = Role::whereIn('name', $allowedRoles)->pluck('name', 'name')->all();
            $opds = Opd::with('formatlaporans.pekerjaanRelasi')->where('id', $currentUser->opd_id)->get();
        }

        $title = "Ubah User";
        $userRoles = $user->roles->pluck('name', 'name')->all();

        // Ambil semua pekerjaan
        $pekerjaans = Pekerjaan::pluck('nama_pekerjaan', 'id')->all();

        return view('role-permission.user.edit', [
            'title' => $title,
            'user' => $user,
            'roles' => $roles,
            'opds' => $opds,
            'userRoles' => $userRoles,
            'isSuperAdmin' => $isSuperAdmin,
            'pekerjaans' => $pekerjaans
        ]);
    }

    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();
        $isSuperAdmin = $currentUser->hasRole('super-admin');

        // Jika bukan super-admin, pastikan hanya bisa update user dari OPD yang sama
        if (!$isSuperAdmin && $currentUser->opd_id !== $user->opd_id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak memiliki izin untuk mengupdate user ini.');
        }

        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'nullable|string|min:8',
                'roles' => 'required|array',
                'roles.*' => 'exists:roles,name',
                'opd_id' => 'required|exists:opds,id',
                'bidang' => 'required|string|max:255',
                'pekerjaan_id' => 'required|exists:pekerjaans,id', // Tambahkan validasi untuk pekerjaan_id
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'roles.required' => 'Role wajib diisi',
                'roles.*.exists' => 'Role tidak valid',
                'opd_id.required' => 'OPD wajib diisi',
                'opd_id.exists' => 'OPD tidak valid',
                'bidang.required' => 'Bidang wajib diisi',
                'bidang.exists' => 'Bidang tidak valid',
                'pekerjaan_id.required' => 'Pekerjaan wajib diisi',
                'pekerjaan_id.exists' => 'Pekerjaan tidak valid',
            ]
        );

        // Validasi tambahan untuk non-super-admin
        if (!$isSuperAdmin) {
            if ($validatedData['opd_id'] != $currentUser->opd_id) {
                return redirect()->back()->withInput()->withErrors(['opd_id' => 'Anda hanya bisa mengupdate user untuk OPD Anda sendiri.']);
            }

            $allowedRoles = ['it-support', 'thl', 'kadis', 'kabid', 'kaban', 'sekretaris', 'kasum', 'kabag', 'kasubag'];
            if (array_diff($validatedData['roles'], $allowedRoles)) {
                return redirect()->back()->withInput()->withErrors(['roles' => 'Anda tidak memiliki izin untuk memberikan role tersebut.']);
            }
        }

        $formatlaporan = Formatlaporan::where('opd_id', $validatedData['opd_id'])
            ->where('bidang', $validatedData['bidang'])
            ->where('pekerjaan_id', $validatedData['pekerjaan_id']) // Tambahkan kondisi untuk pekerjaan_id
            ->first();

        if (!$formatlaporan) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Kombinasi OPD, bidang, dan pekerjaan tidak valid.']);
        }

        $data = [
            'name' => $validatedData['name'],
            'opd_id' => $validatedData['opd_id'],
            'formatlaporan_id' => $formatlaporan->id
        ];

        if (!empty($validatedData['password'])) {
            $data['password'] = Hash::make($validatedData['password']);
        }

        $user->update($data);
        $user->syncRoles($validatedData['roles']);

        return redirect('admin/users')->with('success', 'User updated successfully');
    }

    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return redirect('admin/users')->with('success', 'User deleted successfully');
    }
}
