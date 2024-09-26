{{-- untuk menampilkan tanggal bulan dan tahun rancangan yang dipilih
<div class="text-muted mb-5 hr-text">
    Kegiatan {{ \Carbon\Carbon::today()->translatedFormat('l, j F Y', 'id_ID') }}
</div>
--}}

<div class="text-muted mb-5 hr-text">
    Kegiatan {{ \Carbon\Carbon::today()->translatedFormat('F Y', 'id_ID') }}
</div>

@if ($rancangans->isEmpty())
    <div class="empty">
        <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128"
                alt=""></div>
        <p class="empty-title">Belum ada kegiatan hari ini</p>
        @can('view todolist')
            <p class="empty-subtitle text-secondary">
                Cobalah membuat kegiatan baru dari menu todolist atau klik tombol Buat Todolist Baru di bawah ini
            </p>
            <div class="empty-action">
                <a href="{{ route('todolist') }}" class="btn btn-primary rounded-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Buat Todolist Baru
                </a>
            </div>
        @endcan
    </div>
@else
    
<div class="row row-card row-deck">
    @foreach ($rancangans as $rancangan)
        <div class="col-xl-6">            
            <div class="card mb-3 border-0 rounded-4 shadow-sm">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar rounded-circle" style="background-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                        <path
                                            d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <small>
                                            <span class="strong">{{ $rancangan->user->name }}</span>
                                        </small>
                                        <small class="text-secondary">
                                            <span>{{ $rancangan->created_at->diffForHumans() }}</span>
                                        </small>
                                    </div>
                                    <small class="text-secondary">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            </svg>
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr mb-3 mt-3"></div>

                    <div class="row row-0 align-items-center">
                        @if ($rancangan->foto && file_exists(public_path('assets/images/' . $rancangan->foto)))
                            <div class="col order-last align-self-center">
                                <img src="{{ asset('assets/images/' . $rancangan->foto) }}"
                                    class="rounded-4 float-end"
                                    style="width: 100px; height: 100px; object-fit: cover;"
                                    alt="{{ $rancangan->jenis_kegiatan }}">
                            </div>
                            <div class="col-8 col-md-10 col-xl-9 col-lg-10">
                                <div class="text-md-start">
                                    <h3 class="lh-sm mb-2">{{ $rancangan->jenis_kegiatan }}</h3>
                                    <small>
                                        <p class="mb-2 d-none d-sm-block">
                                            {{ Str::limit($rancangan->pelaksanaan_kerja, 110, '...') }}
                                        </p>
                                    </small>
                                    <small class="d-flex">
                                        <span class="d-inline-flex badge bg-azure text-white">
                                            {{ $rancangan->tempat }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="col-auto">
                                <div class="text-md-start">
                                    <h3 class="lh-sm mb-2">{{ $rancangan->jenis_kegiatan }}</h3>
                                    <small>
                                        <p class="mb-2 d-none d-sm-block">
                                            {{ Str::limit($rancangan->pelaksanaan_kerja, 110, '...') }}
                                        </p>
                                    </small>
                                    <small class="d-flex">
                                        <span class="d-inline-flex badge bg-azure text-white">
                                            {{ $rancangan->tempat }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>          
        </div>
    @endforeach
</div>
    
    <!-- Pagination Links -->

    <div class="d-flex justify-content-center">
        {{ $rancangans->links('layouts.admin.custompagination') }}
    </div>
@endif
