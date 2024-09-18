@extends('layouts.admin.app')
@section('title')
    {{ $title }}
@endsection

@section('content')


    @if (!$hasPermission)

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

                    @include('admin.partials.widget-dashboard')

                    <div class="row justify-content-center">

                        @include('admin.partials.widget-kegiatan')

                    </div>
                </div>
            </div>
        @endif
@endsection
