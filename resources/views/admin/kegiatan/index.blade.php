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
                            <a href="{{ route('kegiatan.create') }}" class="btn btn-outline-black btn-sm rounded-3 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Tambah Kegiatan Baru
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-vcenter table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Kegiatan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatans as $kegiatan)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                                        class="btn btn-sm my-1 rounded-pill px-2"> Edit </a>

                                                    @can('delete kegiatan')
                                                        <a href="{{ route('kegiatan.delete', $kegiatan->id) }}"
                                                            class="btn btn-sm my-1 rounded-pill px-2"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?') ">
                                                            Delete </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
