@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card rounded-4">
                <div class="row g-0">
                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            <h4 class="subheader">pengaturan profil saya</h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Akun Saya</h2>
                            <h3 class="card-title">Foto Profil</h3>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar avatar-xl rounded-circle" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn rounded-4">
                                        Ubah foto profil
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn btn-ghost-danger rounded-4">
                                        Delete foto profil
                                    </a>
                                </div>
                            </div>

                            <div class="hr"></div>
                            
                            <h3 class="card-title mt-4">Informasi Profil</h3>
                            <p class="card-subtitle">Perbaharui informasi profil Anda, nama dan alamat email</p>
                            <div class="row">
                                <div class="card-body">
                                    @include('profile.partials.update-profile-information-form')
                                </div>                      
                            </div>

                            <div class="hr"></div>

                            <h3 class="card-title mt-4">Password</h3>
                            <p class="card-subtitle">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar selalu aman.</p>
                            <div>
                                <div class="row">
                                    <div class="card-body">
                                        @include('profile.partials.update-password-form')
                                    </div>
                                </div>
                            </div>

                            <div class="hr"></div>

                            <h3 class="card-title mt-4">Hapus Akun</h3>
                            <p class="card-subtitle text-danger">Setelah akun Anda dihapus, semua sumber daya dan data yang terkait akan dihapus secara permanen. Sebelum menghapus
                                akun, silakan backup data atau informasi apa pun yang ingin Anda simpan.</p>
                            <div>
                                <div class="row">
                                    <div class="card-body">
                                        @include('profile.partials.delete-user-form')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
