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
                            <a href="{{ route('formatlaporan.create') }}"
                                class="btn btn-outline-black btn-sm rounded-3 px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Buat Format Laporan Baru
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="formatlaporans-table"
                                    class="table table-striped table-hover table-vcenter table-sm">
                                    <thead>
                                        <tr>
                                            <th class="col-1 text-center">No</th>
                                            <th>OPD</th>
                                            <th>Bidang</th>
                                            <th>Jabatan</th>
                                            <th>Nama Pejabat</th>
                                            <th>Pekerjaan Dibawahi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- data rancangan --}}
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

@push('js')
    <script>
        $(function() {
            $('#formatlaporans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('formatlaporan.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'opd_name',
                        name: 'opd.name'
                    },
                    {
                        data: 'bidang',
                        name: 'bidang'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'kabid',
                        name: 'kabid'
                    },
                    {
                        data: 'pekerjaan_name',
                        name: 'pekerjaan.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
