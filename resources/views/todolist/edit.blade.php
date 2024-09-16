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

                        <div class="card-header">
                            <div class="card-title">Update Data Todolist</div>
                        </div>

                        <div class="card-body p-4">

                            <form action="{{ route('todolist.update', $rancangan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="kegiatan_id" class="form-label">Kegiatan</label>
                                                <select name="kegiatan_id" id="kegiatan_id"
                                                    class="form-select rounded-4 @error('kegiatan_id') is-invalid @enderror">
                                                    <option value="" class="dropdown-header" disabled selected>Pilih Kegiatan</option>
                                                    @foreach (\App\Models\Kegiatan::all() as $kegiatan)
                                                        <option value="{{ $kegiatan->id }}"
                                                            {{ $rancangan->kegiatan_id == $kegiatan->id ? 'selected' : '' }}>
                                                            {{ $kegiatan->nama_kegiatan }}</option>
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
                                                    value="{{ $rancangan->jenis_kegiatan }}">

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
                                                    value="{{ $rancangan->tanggal }}">

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
                                                    value="{{ $rancangan->tempat }}">

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
                                                <label class="form-label required">Pelaksanaan Kerja</label>
                                                <div>
                                                    <textarea class="form-control rounded-4 @error('pelaksanaan_kerja') is-invalid @enderror" name="pelaksanaan_kerja" rows="8"
                                                        data-bs-toggle="autosize" placeholder="Deskripsi pekerjaan yang dikerjakan">{{ old('pelaksanaan_kerja', $rancangan->pelaksanaan_kerja) }}</textarea>
                                                    @error('pelaksanaan_kerja')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="progress" class="form-label">Progress</label>
                                                <input type="number" name="progress" id="progress"
                                                    class="form-control rounded-4 @error('progress') is-invalid @enderror"
                                                    min="0" max="100" value="{{ $rancangan->progress }}">

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
                                                    @if ($rancangan->foto)
                                                        <img src="{{ asset('assets/images/' . $rancangan->foto) }}"
                                                            alt="Foto IT Request" class="img-thumbnail mt-2" width="400">
                                                    @endif
                                                    <small class="form-hint">File gambar: jpg, jpeg, png, dan gif. Ukuran maksimal 2MB. Jika tidak ada foto atau dokumentasi, mohon dikosongkan.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary py-2 rounded-4">Update</button>
                                    <a href="{{ route('todolist.laporan') }}" class="btn btn-danger py-2 rounded-4 ms-1">Batal</a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
