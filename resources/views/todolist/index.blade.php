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
                        <div class="card-body p-4">
                            <form action="{{ route('todolist.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="kegiatan_id" class="form-label">Kegiatan</label>
                                                <select id="kegiatan_id" name="kegiatan_id"
                                                    class="form-select rounded-4 @error('kegiatan_id') is-invalid @enderror">
                                                    <option class="dropdown-header" disabled selected>Pilih Kegiatan
                                                    </option>
                                                    @foreach (\App\Models\Kegiatan::all() as $kegiatan)
                                                        <option value="{{ $kegiatan->id }}"
                                                            {{ old('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>
                                                            {{ $kegiatan->nama_kegiatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kegiatan_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                                                <input type="text" name="jenis_kegiatan" id="jenis_kegiatan"
                                                    class="form-control rounded-4 @error('jenis_kegiatan') is-invalid @enderror"
                                                    value="{{ old('jenis_kegiatan') }}"
                                                    placeholder="Masukkan Nama Kegiatan Contoh : Zoom Meeting">
                                                @error('jenis_kegiatan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" name="tanggal" id="tanggal"
                                                    class="form-control rounded-4 @error('tanggal') is-invalid @enderror"
                                                    value="{{ old('tanggal') }}">
                                                @error('tanggal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label for="tempat" class="form-label">Tempat</label>
                                                <input type="text" name="tempat" id="tempat"
                                                    class="form-control rounded-4 @error('tempat') is-invalid @enderror"
                                                    value="{{ old('tempat') }}"
                                                    placeholder="Lokasi tempat kegiatan dilaksanakan">
                                                @error('tempat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="pelaksanaan_kerja" class="form-label">Pelaksanaan Kerja</label>
                                                <textarea name="pelaksanaan_kerja" id="pelaksanaan_kerja"
                                                    class="form-control rounded-4 @error('pelaksanaan_kerja') is-invalid @enderror" rows="8"
                                                    data-bs-toggle="autosize"
                                                    placeholder="Masukkan nama acara atau deskripsi pekerjaan yang dilaksanakan contoh : Rakor Inflasi Daerah">{{ old('pelaksanaan_kerja') }}</textarea>
                                                @error('pelaksanaan_kerja')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="progress" class="form-label">Progress</label>
                                                <input type="number" name="progress" id="progress"
                                                    class="form-control rounded-4 @error('progress') is-invalid @enderror"
                                                    value="{{ old('progress') }}" min="0" max="100"
                                                    placeholder="Masukkan angka antara 0-100">
                                                @error('progress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <div>
                                                    <input type="file" name="foto" class="form-control rounded-4"
                                                        id="foto" />
                                                    <small class="form-hint">
                                                        File gambar: jpg, jpeg, png, dan gif. Ukuran maksimal 2MB. Jika
                                                        tidak ada foto atau dokumentasi, mohon dikosongkan.
                                                    </small>
                                                    @error('foto')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('add todolist')
                                        <button type="submit" class="btn btn-primary rounded-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                            </svg>
                                            Simpan
                                        </button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-danger rounded-4 ms-1">
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
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
