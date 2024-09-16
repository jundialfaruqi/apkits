@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck">
                <div class="col-md-12 col-lg-12 col-xl-6">
                    <div class="card shadow-sm border-0 rounded-4 mb-3">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Informasi Profil</div>
                        </div>
                        <div class="card-body pb-1">

                            @include('profile.partials.update-profile-information-form')

                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 col-xl-6">

                    <div class="card shadow-sm border-0 rounded-4 mb-3">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Ubah Password</div>
                        </div>
                        <div class="card-body pb-1">

                            @include('profile.partials.update-password-form')

                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-sm col-xl-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Hapus Akun</div>
                        </div>
                        <div class="card-body pb-1">

                            @include('profile.partials.delete-user-form')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
