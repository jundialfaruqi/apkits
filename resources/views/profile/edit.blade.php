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
                                <div class="card rounded-4 border-0 mb-3 bg-transparent">
                                    @include('profile.partials.update-photo')
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
