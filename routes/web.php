<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KesimpulanController;
use App\Http\Controllers\Admin\AllTodolistController;
use App\Http\Controllers\HomePage\HomePageController;
use App\Http\Controllers\Admin\FormatLaporanController;

// 1. Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['middleware' => ['auth', 'role:super-admin']], function () {

    // 2. Roles
    Route::resource('admin/roles', App\Http\Controllers\RoleController::class);
    Route::get('admin/roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('admin/roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('admin/roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole'])
        ->name('admin.roles.give-permissions');

    // 3. Permissions
    Route::resource('admin/permissions', App\Http\Controllers\PermissionController::class);
    Route::get('admin/permissions/{permissionsId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
});

// 4. Users
Route::group(['middleware' => ['auth', 'role:super-admin|admin']], function () {
    Route::resource('admin/users', App\Http\Controllers\UserController::class);
});
Route::group(['middleware' => ['auth', 'role:super-admin|admin']], function () {
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])
        ->name('user.index');
});
Route::get('admin/users/{usersId}/delete', [App\Http\Controllers\UserController::class, 'destroy'])
    ->middleware(['auth', 'permission:delete user']);

// 5. Kegiatan
Route::get('admin/kegiatan', [App\Http\Controllers\Admin\KegiatanController::class, 'index'])
    ->middleware(['auth', 'permission:view kegiatan'])
    ->name('kegiatan.index');

Route::get('admin/kegiatan/create', [App\Http\Controllers\Admin\KegiatanController::class, 'create'])
    ->middleware(['auth', 'permission:add kegiatan'])
    ->name('kegiatan.create');

Route::post('admin/kegiatan/store', [App\Http\Controllers\Admin\KegiatanController::class, 'store'])
    ->middleware(['auth', 'permission:add kegiatan'])
    ->name('kegiatan.store');

Route::get('admin/kegiatan/{kegiatanId}/edit', [App\Http\Controllers\Admin\KegiatanController::class, 'edit'])
    ->middleware(['auth', 'permission:edit kegiatan'])
    ->name('kegiatan.edit');

Route::put('admin/kegiatan/{kegiatanId}/update', [App\Http\Controllers\Admin\KegiatanController::class, 'update'])
    ->middleware(['auth', 'permission:edit kegiatan'])
    ->name('kegiatan.update');

Route::delete('admin/kegiatan/{kegiatanId}/delete', [App\Http\Controllers\Admin\KegiatanController::class, 'destroy'])
    ->middleware(['auth', 'permission:delete kegiatan'])
    ->name('kegiatan.delete');

// 6. Semua Data Todolist
Route::get('admin/semua-data-todolist', [AllTodolistController::class, 'index'])
    ->name('semuadatatodolist')
    ->middleware(['auth', 'role:super-admin|admin']);

// 7. OPD
Route::group(['middleware' => ['auth', 'role:super-admin']], function () {
    Route::get('admin/opd', [App\Http\Controllers\Admin\OpdController::class, 'index'])
        ->name('opd.index');
    Route::get('admin/opd/create', [App\Http\Controllers\Admin\OpdController::class, 'create'])
        ->name('opd.create');
    Route::post('admin/opd/store', [App\Http\Controllers\Admin\OpdController::class, 'store'])
        ->name('opd.store');
    Route::get('admin/opd/{opdId}/edit', [App\Http\Controllers\Admin\OpdController::class, 'edit'])
        ->name('opd.edit');
    Route::put('admin/opd/{opd}/update', [App\Http\Controllers\Admin\OpdController::class, 'update'])
        ->name('opd.update');
    Route::delete('admin/opd/{opdId}/delete', [App\Http\Controllers\Admin\OpdController::class, 'destroy'])
        ->name('opd.delete');
});

// 8. Format Laporan
Route::group(['middleware' => ['auth', 'role:super-admin|admin']], function () {
    Route::get('/admin/format-laporan', [FormatLaporanController::class, 'index'])
        ->name('formatlaporan.index');
    Route::get('/admin/format-laporan/create', [FormatLaporanController::class, 'create'])
        ->name('formatlaporan.create');
    Route::post('/admin/format-laporan/store', [FormatLaporanController::class, 'store'])
        ->name('formatlaporan.store');
    Route::get('/admin/format-laporan/{formatlaporanId}/edit', [FormatLaporanController::class, 'edit'])
        ->name('formatlaporan.edit');
    Route::put('/admin/format-laporan/{formatlaporanId}/update', [FormatLaporanController::class, 'update'])
        ->name('formatlaporan.update');
    Route::delete('/admin/format-laporan/{formatlaporanId}/delete', [FormatLaporanController::class, 'destroy'])
        ->name('formatlaporan.delete');
});

// 9. Todolist
Route::middleware('auth')->group(function () {
    Route::get('todolist/', [TodolistController::class, 'index'])->name('todolist')
        ->middleware('permission:view todolist');
    Route::post('todolist/', [TodolistController::class, 'store'])->name('todolist.store')
        ->middleware('permission:add todolist');
    Route::delete('todolist/{todolistId}/delete', [TodolistController::class, 'destroy'])
        ->name('todolist.delete')
        ->middleware(['permission:delete todolist']);
    Route::get('todolist/{todolistId}/edit', [TodolistController::class, 'edit'])->name('todolist.edit')
        ->middleware('permission:edit todolist');
    Route::put('todolist/{todolist}/update', [TodolistController::class, 'update'])->name('todolist.update');
});

// 10. Kesimpulan Laporan
Route::middleware(['auth'])->group(function () {
    // Kesimpulan Index
    Route::get('/laporan/kesimpulan', [KesimpulanController::class, 'index'])
        ->middleware('permission:view kesimpulan|view all kesimpulan')
        ->name('kesimpulan.index');

    // Kesimpulan Create
    Route::get('/laporan/kesimpulan/create', [KesimpulanController::class, 'create'])
        ->middleware('permission:create kesimpulan')
        ->name('kesimpulan.create');

    // Kesimpulan Store
    Route::post('/laporan/kesimpulan/store', [KesimpulanController::class, 'store'])
        ->middleware('permission:create kesimpulan')
        ->name('kesimpulan.store');

    // Kesimpulan Edit
    Route::get('/laporan/kesimpulan/{kesimpulanId}/edit', [KesimpulanController::class, 'edit'])
        ->middleware('permission:edit kesimpulan')
        ->name('kesimpulan.edit');

    // Kesimpulan Update
    Route::put('/laporan/kesimpulan/{kesimpulanId}/update', [KesimpulanController::class, 'update'])
        ->middleware('permission:edit kesimpulan')
        ->name('kesimpulan.update');

    // Kesimpulan Delete
    Route::delete('/laporan/kesimpulan/{kesimpulanId}/delete', [KesimpulanController::class, 'destroy'])
        ->middleware('permission:delete kesimpulan')
        ->name('kesimpulan.delete');
});

// 9. Rekap laporan bulanan
Route::get('todolist/laporan', [LaporanController::class, 'index'])->name('todolist.laporan')
    ->middleware(['auth', 'permission:view todolist']);

// 10. Export PDF
Route::get('/todolist/export-pdf', [LaporanController::class, 'exportPdf'])->name('todolist.export-pdf')
    ->middleware(['auth', 'permission:export pdf']);

// 11. Profile
Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit')
        ->middleware('auth', 'permission:edit profile');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy')
        ->middleware('auth', 'permission:delete account');
});

// Pekerjaan
Route::group(['middleware' => ['auth', 'role:super-admin']], function () {
    Route::get('/admin/pekerjaan', [App\Http\Controllers\Admin\PekerjaanController::class, 'index'])
        ->name('pekerjaan.index');
    Route::get('/admin/pekerjaan/create', [App\Http\Controllers\Admin\PekerjaanController::class, 'create'])
        ->name('pekerjaan.create');
    Route::post('/admin/pekerjaan/store', [App\Http\Controllers\Admin\PekerjaanController::class, 'store'])
        ->name('pekerjaan.store');
    Route::get('/admin/pekerjaan/{pekerjaanId}/edit', [App\Http\Controllers\Admin\PekerjaanController::class, 'edit'])
        ->name('pekerjaan.edit');
    Route::put('/admin/pekerjaan/{pekerjaan}/update', [App\Http\Controllers\Admin\PekerjaanController::class, 'update'])
        ->name('pekerjaan.update');
    Route::delete('/admin/pekerjaan/{pekerjaanId}/delete', [App\Http\Controllers\Admin\PekerjaanController::class, 'destroy'])
        ->name('pekerjaan.delete');
});

// 12. Landing Pages Blog
Route::get('/', [HomePageController::class, 'index'])->name('apkits');

//13. Statistik
Route::get('/admin/statistik', [App\Http\Controllers\Admin\StatistikController::class, 'index'])
    ->middleware(['auth', 'permission:view statistik'])
    ->name('statistik.index');

require __DIR__ . '/auth.php';
