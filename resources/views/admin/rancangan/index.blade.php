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
                        @if (session('success'))
                            <div id="autoCloseAlert" class="alert alert-important alert-dismissible rounded-top-4 rounded-bottom-0 mb-0" role="alert">
                                <div class="d-flex">
                                    <div>
                                        <!-- Download SVG icon from http://tabler-icons.io/i/info-circle -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        {{ session('success') }}
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var alert = document.getElementById('autoCloseAlert');
                                    if (alert) {
                                        setTimeout(function() {
                                            var bsAlert = new bootstrap.Alert(alert);
                                            bsAlert.close();
                                        }, 5000);
                                    }
                                });
                            </script>
                        @endif
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
                                            <th>User</th>
                                            <th>Role</th>
                                            <th>Kegiatan</th>
                                            <th>Jenis Kegiatan</th>
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

            var columns = [
                {
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
                    data: 'user_roles',
                    name: 'user.roles.name'
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
