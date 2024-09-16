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
                            <div id="autoCloseAlert"
                                class="alert alert-important alert-dismissible rounded-top-4 rounded-bottom-0 mb-0"
                                role="alert">
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
                        <div class="card-header">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 my-1">
                                        <div class="input-group rounded-4">
                                            <span class="input-group-text rounded-start-4" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                                Bulan
                                            </span>
                                            @php
                                                $bulanIndonesia = [
                                                    1 => 'Januari',
                                                    2 => 'Februari',
                                                    3 => 'Maret',
                                                    4 => 'April',
                                                    5 => 'Mei',
                                                    6 => 'Juni',
                                                    7 => 'Juli',
                                                    8 => 'Agustus',
                                                    9 => 'September',
                                                    10 => 'Oktober',
                                                    11 => 'November',
                                                    12 => 'Desember',
                                                ];
                                            @endphp

                                            <select id="bulan" class="form-select rounded-end-4">
                                                <option value="">Pilih Bulan</option>
                                                @foreach ($bulanIndonesia as $angka => $nama)
                                                    <option value="{{ $angka }}"
                                                        {{ $angka == date('m') ? 'selected' : '' }}>{{ $nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 my-1">
                                        <div class="input-group rounded-4">
                                            <span class="input-group-text rounded-start-4" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M7 14h.013" />
                                                    <path d="M10.01 14h.005" />
                                                    <path d="M13.01 14h.005" />
                                                    <path d="M16.015 14h.005" />
                                                    <path d="M13.015 17h.005" />
                                                    <path d="M7.01 17h.005" />
                                                    <path d="M10.01 17h.005" />
                                                </svg>
                                                Tahun
                                            </span>
                                            <select id="tahun" class="form-select rounded-end-4">
                                                <option value="">Pilih Tahun</option>
                                                @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                                    <option value="{{ $i }}"
                                                        {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="filter" type="button" class="btn btn-primary rounded-4 my-1 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                            <span class=>Lihat</span>
                                        </button>

                                        <a id="exportPdf" href="{{ route('todolist.export-pdf') }}" target="_blank"
                                            class="btn btn-danger rounded-4 my-1" aria-label="Button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                <path d="M17 18h2" />
                                                <path d="M20 15h-3v6" />
                                                <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                            </svg>
                                            <span>Export PDF</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="rancangans-table"
                                    class="table table-striped table-hover table-vcenter table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kegiatan</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Tanggal Pekerjaan</th>
                                            <th>Waktu dan Tempat</th>
                                            <th>Pelaksanaan Kerja</th>
                                            <th>Progress dalam 100%</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- data todolist --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content rounded-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <p class="strong text-red mb-1">Error!</p>
                    <div class="text-secondary mb-3">Harap pilih bulan dan tahun.</div>
                    <div class="col"><a href="#" class="btn w-50 rounded-4" data-bs-dismiss="modal">
                            Oke
                        </a></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#rancangans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('todolist.laporan') }}',
                    data: function(d) {
                        d.bulan = $('#bulan').val() || ''; // Set default jika kosong
                        d.tahun = $('#tahun').val() || ''; // Set default jika kosong
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'kegiatan_nama',
                        name: 'kegiatan.nama_kegiatan'
                    },
                    {
                        data: 'jenis_kegiatan',
                        name: 'jenis_kegiatan',
                        render: function(data, type, row, meta) {
                            if (type === 'display' && data) {
                                const maxWords = 3;
                                let words = data.split(' ');
                                if (words.length > maxWords) {
                                    words = words.slice(0, maxWords).join(' ') + '...';
                                } else {
                                    words = words.join(' ');
                                }
                                return words;
                            }
                            return data;
                        }
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
                        data: 'pelaksanaan_kerja',
                        name: 'pelaksanaan_kerja',
                        render: function(data, type, row, meta) {
                            if (type === 'display' && data) {
                                const maxWords = 3;
                                let words = data.split(' ');
                                if (words.length > maxWords) {
                                    words = words.slice(0, maxWords).join(' ') + '...';
                                } else {
                                    words = words.join(' ');
                                }
                                return words;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'progress',
                        name: 'progress'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Update DataTable ketika halaman dimuat pertama kali
            updateTableData();

            // Event handler untuk tombol filter
            $('#filter').click(function() {
                updateTableData();
            });

            // Event handler untuk tombol export PDF
            $('#exportPdf').click(function() {
                updateExportPdfUrl();
            });

            function updateTableData() {
                if (checkInputsAndUpdate()) {
                    table.ajax.reload(); // Reload data dari server
                }
            }

            function checkInputsAndUpdate() {
                const bulan = $('#bulan').val();
                const tahun = $('#tahun').val();

                if (!bulan || !tahun) {
                    $('#warningModal').modal('show');
                    return false;
                }

                updateExportPdfUrl();
                return true;
            }

            function updateExportPdfUrl() {
                var baseUrl = "{{ route('todolist.export-pdf') }}";
                var params = $.param({
                    bulan: $('#bulan').val(),
                    tahun: $('#tahun').val()
                });
                $('#exportPdf').attr('href', baseUrl + '?' + params);
            }
        });
    </script>
@endpush
