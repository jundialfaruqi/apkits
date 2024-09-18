@extends('layouts.admin.app')
@section('title')
    {{ $title }}
@endsection

@section('content')


    @if (!$hasPermission)
        <!-- Gunakan variabel yang dikirim dari controller -->
        <!-- Modal -->
        <div class="modal modal-blur fade show d-block" tabindex="-1" aria-labelledby="unverifiedAccountLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unverifiedAccountLabel">Akun Belum Diverifikasi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon mb-2 text-danger icon-lg icons-tabler-outline icon-tabler-lock-access">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                <path d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                <path d="M10 11v-2a2 2 0 1 1 4 0v2" />
                            </svg>

                        </div>
                        <p class="small text-muted text-center">
                            Akun anda belum diverifikasi. Silakan hubungi administrator untuk verifikasi.
                        </p>
                    </div>
                    <div class="modal-footer rounded-bottom-4">
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-4 w-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay untuk mencegah interaksi di luar modal -->
        <div class="modal-backdrop fade show"></div>
        @else
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row justify-content-evenly">
                        <div class="col-md-4 mb-3">
                            <div class="card d-flex flex-column border-0 rounded-4 shadow-sm">
                                <div class="row row-0 flex-fill">
                                    <div class="col">
                                        <div class="card-body">
                                            <h3 class="card-title mb-2"><a href="#">Selamat Datang</a></h3>
                                            <small class="text-secondary">Di APKITS, Aplikasi Pelaporan Kegiatan IT Support {{ Auth::user()->opd->name }} Kota Pekanbaru</small>
                                            <div class="d-flex align-items-center pt-2 mt-auto">
                                                <div>
                                                    <a href="#" class="text-body me-1 btn btn-sm bg-azure-lt rounded-4 shadow-sm py-2 px-2 mb-1">Bantuan</a>
                                                    <a href="#" class="text-body btn btn-sm bg-gray-50 rounded-4 shadow-sm py-2 px-2 mb-1">Tentang</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8 mb-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="bg-primary text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            THL
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $thlCount }} Orang
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="bg-azure text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            IT Support
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $itCount }} Orang
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="bg-purple text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                                <path d="M18.5 18.5l2.5 2.5" />
                                                                <path d="M4 6h16" />
                                                                <path d="M4 12h4" />
                                                                <path d="M4 18h4" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            Hari Ini
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $totalRancangansToday }} kagiatan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="bg-teal text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                                <path d="M16 3v4" />
                                                                <path d="M8 3v4" />
                                                                <path d="M4 11h16" />
                                                                <path d="M7 14h.013" />
                                                                <path d="M10.01 14h.005" />
                                                                <path d="M13.01 14h.005" />
                                                                <path d="M16.015 14h.005" />
                                                                <path d="M13.015 17h.005" />
                                                                <path d="M7.01 17h.005" />
                                                                <path d="M10.01 17h.005" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            Bulan Ini
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $totalRancangansMounth }} Kegiatan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span
                                                            class="bg-indigo text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-mist">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M5 5h3m4 0h9" />
                                                                <path d="M3 10h11m4 0h1" />
                                                                <path d="M5 15h5m4 0h7" />
                                                                <path d="M3 20h9m4 0h3" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            Semua
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $totalRancangans }} Kegiatan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12 col-xl-7">

                            <div class="text-center text-muted mb-3">
                                Kegiatan {{ \Carbon\Carbon::today()->translatedFormat('l, j F Y', 'id_ID') }}
                            </div>

                            @if ($rancangans->isEmpty())
                                <div class="empty">
                                    <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128" alt=""></div>
                                    <p class="empty-title">Tidak ada kegiatan ditemukan</p>
                                    <p class="empty-subtitle text-secondary">
                                        Cobalah membuat kegiatan baru dari menu todolist atau klik tombol Buat Todolist Baru di bawah ini
                                    </p>
                                    <div class="empty-action">
                                        <a href="{{ route('todolist') }}" class="btn btn-primary rounded-4">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                            Buat Todolist Baru
                                        </a>
                                    </div>
                                </div>
                    
                            @else
                                @foreach ($rancangans as $rancangan)
                                    <div class="row">
                                        <small class="text-secondary d-inline-flex align-items-center px-3 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                            </svg>
                                            <span class="ms-1">{{ $rancangan->user->name }}</span>
                                        </small>
                                    </div>

                                    <div class="card mb-3 border-0 rounded-4 shadow-sm">
                                        <div class="card-body">
                                            <div class="row row-0 align-items-center">
                                                <div class="col order-last align-self-center">
                                                    @if ($rancangan->foto && file_exists(public_path('assets/images/' . $rancangan->foto)))
                                                        <img src="{{ asset('assets/images/' . $rancangan->foto) }}"
                                                            class="rounded-4 float-end"
                                                            style="width: 100px; height: 100px; object-fit: cover;"
                                                            alt="{{ $rancangan->jenis_kegiatan }}">
                                                    @else
                                                        <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                            class="rounded-3 float-end"
                                                            style="width: 100px; height: 100px; object-fit: cover;"
                                                            alt="Placeholder Image">
                                                    @endif
                                                </div>
                                                <div class="col-8 col-md-10 col-xl-10 col-lg-10">
                                                    <div class="text-md-start">
                                                        <h3 class="lh-sm mb-2">{{ $rancangan->jenis_kegiatan }}</h3>
                                                        <small>
                                                            <p class="mb-2 d-none d-sm-block">
                                                                {{ Str::limit($rancangan->pelaksanaan_kerja, 120, '...') }}
                                                            </p>
                                                        </small>
                                                        <small
                                                            class="text-secondary d-flex flex-wrap justify-content-md-start">
                                                            <span class="d-inline-flex align-items-center">
                                                                {{ $rancangan->created_at->diffForHumans() }} -
                                                                {{ $rancangan->tempat }}
                                                            </span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center">
                                    {{ $rancangans->links('layouts.admin.custompagination') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
@endsection
