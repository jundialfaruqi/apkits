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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Data Seluruh Todolist
                            </div>
                            @role('super-admin')
                                <div class="opd-filter">
                                    <select id="opd-filter" class="form-select rounded-4">
                                        <option value="">Semua OPD</option>
                                        @foreach ($opds as $opd)
                                            <option value="{{ $opd->id }}">{{ $opd->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endrole
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rancangans-table" class="table table-striped table-hover table-vcenter table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kegiatan</th>
                                            <th>Kegiatan</th>
                                            <th>Tanggal</th>
                                            <th>Tempat</th>
                                            <th>Progress</th>

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
        $(document).ready(function() {
            var isSuperAdmin = {{ $isSuperAdmin ? 'true' : 'false' }};

            var columns = [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'user_name',
                    name: 'user.name'
                },
                {
                    data: 'kegiatan_nama',
                    name: 'kegiatan.nama_kegiatan'
                },
                {
                    data: 'jenis_kegiatan',
                    name: 'jenis_kegiatan'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    data: 'tempat',
                    name: 'tempat'
                },
                {
                    data: 'progress',
                    name: 'progress'
                }
            ];

            if (isSuperAdmin) {
                columns.push({
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                });
            }

            var table = $('#rancangans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('semuadatatodolist') }}",
                    data: function(d) {
                        d.opd_id = $('#opd-filter').val();
                    }
                },
                columns: columns,
            });

            $('#opd-filter').on('change', function() {
                table.ajax.reload();
            });
        });
    </script>
@endpush
