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

                        <div class="card-header justify-content-between">
                            <div class="card-title">Form Edit Format Laporan</div>
                            <a href="{{ route('formatlaporan.index') }}" class="navbar-brand" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="Batal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="#f03838" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-x">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-6.489 5.8a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" />
                                </svg>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('formatlaporan.update', $formatlaporan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if ($isSuperAdmin)
                                                <div class="mb-3">
                                                    <label for="opd_id" class="form-label">OPD</label>
                                                    <select name="opd_id" id="opd_id"
                                                        class="form-select rounded-4 @error('opd_id') is-invalid @enderror">
                                                        <option value="" class="dorpdown-header" selected disabled>
                                                            Pilih OPD</option>
                                                        @foreach ($opds as $opd)
                                                            <option value="{{ $opd->id }}"
                                                                {{ $formatlaporan->opd_id == $opd->id ? 'selected' : '' }}>
                                                                {{ $opd->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('opd_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="mb-3">
                                                    <label for="opd_id" class="form-label">OPD</label>
                                                    <input type="text" class="form-control rounded-4"
                                                        value="{{ $formatlaporan->opd->name }}" readonly>
                                                    <input type="hidden" name="opd_id"
                                                        value="{{ $formatlaporan->opd_id }}">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="bidang" class="form-label">Bidang</label>
                                                <input type="text" name="bidang" id="bidang"
                                                    class="form-control rounded-4 @error('bidang') is-invalid @enderror"
                                                    value="{{ $formatlaporan->bidang }}">

                                                @error('bidang')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kabid" class="form-label">Pejabat</label>
                                                <input type="text" name="kabid" id="kabid"
                                                    class="form-control rounded-4 @error('kabid') is-invalid @enderror"
                                                    value="{{ $formatlaporan->kabid }}">
                                                @error('kabid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <input type="text" name="jabatan" id="jabatan"
                                                    class="form-control rounded-4 @error('jabatan') is-invalid @enderror"
                                                    value="{{ $formatlaporan->jabatan }}">
                                                @error('jabatan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="nip" class="form-label">NIP</label>
                                                <input type="text" name="nip" id="nip"
                                                    class="form-control rounded-4 @error('nip') is-invalid @enderror"
                                                    value="{{ $formatlaporan->nip }}">
                                                @error('nip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="latar_belakang" class="form-label">Latar Belakang</label>
                                                <textarea class="form-control rounded-4 @error('latar_belakang') is-invalid @enderror" name="latar_belakang"
                                                    rows="8" data-bs-toggle="autosize" placeholder="Deskripsi latar belakang">{{ old('latar_belakang', $formatlaporan->latar_belakang) }}</textarea>
                                                @error('latar_belakang')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="maksud_tujuan" class="form-label">Maksud dan Tujuan</label>
                                                <input type="text" name="maksud_tujuan" id="maksud_tujuan"
                                                    class="form-control rounded-4 @error('maksud_tujuan') is-invalid @enderror"
                                                    value="{{ $formatlaporan->maksud_tujuan }}">
                                                @error('maksud_tujuan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="ruang_lingkup" class="form-label">Ruang Lingkup</label>
                                                <textarea class="form-control rounded-4 @error('ruang_lingkup') is-invalid @enderror" name="ruang_lingkup"
                                                    rows="8" data-bs-toggle="autosize" placeholder="Deskripsi latar belakang">{{ old('ruang_lingkup', $formatlaporan->ruang_lingkup) }}</textarea>
                                                @error('ruang_lingkup')
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
                                                <label class="form-label">Logo Dinas</label>
                                                <div>
                                                    <input type="file" name="logo_dinas"
                                                        class="form-control rounded-4 mb-3" id="logo_dinas" />
                                                    @if ($formatlaporan->logo_dinas)
                                                        <img src="{{ asset('assets/images/' . $formatlaporan->logo_dinas) }}"
                                                            alt="logo_dinas" class="img-thumbnail mt-2 rounded-4"
                                                            width="400">
                                                    @endif
                                                    <small class="form-hint">File gambar: jpg, jpeg, png, dan gif.
                                                        Ukuran
                                                        maksimal
                                                        5MB</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                <select name="pekerjaan_id" id="pekerjaan_id"
                                                    class="form-select rounded-4 @error('pekerjaan_id') is-invalid @enderror">
                                                    <option value="" class="dorpdown-header" selected disabled>
                                                        Pilih Pekerjaan</option>
                                                    @foreach ($pekerjaans as $pekerjaan)
                                                        <option value="{{ $pekerjaan->id }}"
                                                            {{ $formatlaporan->pekerjaan_id == $pekerjaan->id ? 'selected' : '' }}>
                                                            {{ $pekerjaan->nama_pekerjaan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pekerjaan_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                    <a href="{{ route('formatlaporan.index') }}" class="btn btn-danger rounded-4 ms-1">
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
    </div>
@endsection
