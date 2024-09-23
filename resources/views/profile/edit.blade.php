@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card rounded-4 border-0 bg-transparent">
                        {{-- <div class="card-body"> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card rounded-4 mb-3 bg-transparent">
                                    <div class="card-body text-center">
                                        <span class="avatar avatar-xl rounded-circle mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                                <path
                                                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                            </svg>
                                        </span>
                                        <h3 class="card-title mb-3">{{ auth()->user()->name }}</h3>
                                        <div>
                                            <a href="#" class="btn btn-icon rounded-4 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-photo-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M15 8h.01" />
                                                    <path
                                                        d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                                    <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                                    <path
                                                        d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                                </svg>
                                            </a>
                                            <a href="#" class="btn btn-icon rounded-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card rounded-4 mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Informasi Profil</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-subtitle">
                                            Perbaharui informasi profil Anda, nama dan alamat email
                                        </p>
                                        <div class="row">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Password</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-subtitle">
                                            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar selalu
                                            aman.
                                        </p>
                                        <div class="row">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Hapus Akun</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-subtitle text-danger">
                                            Setelah akun Anda dihapus, semua sumber daya dan data yang terkait akan
                                            dihapus
                                            secara permanen. Sebelum menghapus akun, pastikan Anda telah menyimpan
                                            sumber
                                            daya
                                            atau informasi yang ingin Anda hapus. Silakan backup data atau informasi apa
                                            pun
                                            yang ingin Anda simpan.
                                        </p>
                                        <div class="row">
                                            @include('profile.partials.delete-user-form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
