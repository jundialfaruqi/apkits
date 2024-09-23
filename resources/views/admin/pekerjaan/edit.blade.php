@extends('layouts.admin.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card border-0 rounded-4 shadow-sm">
                        <form action="{{ route('pekerjaan.update', $pekerjaan) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Nama Pekerjaan</label>
                                            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan"
                                                class="form-control rounded-4 @error('nama_pekerjaan') is-invalid @enderror"
                                                value="{{ $pekerjaan->nama_pekerjaan }}">

                                            @error('nama_pekerjaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer rounded-bottom-4">
                                <button type="submit" class="btn btn-primary rounded-4 my-1 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Simpan
                                </button>
                                <a href="{{ route('pekerjaan.index') }}" class="btn btn-danger rounded-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
