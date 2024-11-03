{{-- untuk menampilkan tanggal bulan dan tahun rancangan yang dipilih
<div class="text-muted mb-5 hr-text">
    Kegiatan {{ \Carbon\Carbon::today()->translatedFormat('l, j F Y', 'id_ID') }}
</div>
--}}

<div class="text-muted mb-5 hr-text">
    Kegiatan
    @if (Auth::user()->opd)
        {{ Auth::user()->opd->name }}
    @else
        Pemerintah
    @endif
    Kota Pekanbaru
</div>

<div class="d-flex justify-content-end mb-4">
    <div class="dropdown">
        <button class="btn dropdown-toggle rounded-4 border-0 shadow-sm" type="button" id="filterDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path
                    d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.414 -4.414a2 2 0 0 1 -.586 -1.414v-2.172z">
                </path>
            </svg>
            {{ request('filter', 'Bulan Ini') }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
            <li><a class="dropdown-item {{ request('filter') == 'Hari Ini' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => 'Hari Ini']) }}">Hari Ini</a></li>
            <li><a class="dropdown-item {{ request('filter') == 'Kemarin' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => 'Kemarin']) }}">Kemarin</a></li>
            <li><a class="dropdown-item {{ request('filter') == '7 Hari Terakhir' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => '7 Hari Terakhir']) }}">7 Hari Terakhir</a></li>
            <li><a class="dropdown-item {{ request('filter') == 'Bulan Ini' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => 'Bulan Ini']) }}">Bulan Ini</a></li>
            <li><a class="dropdown-item {{ request('filter') == 'Bulan Lalu' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => 'Bulan Lalu']) }}">Bulan Lalu</a></li>
            <li><a class="dropdown-item {{ request('filter') == '30 Hari Terakhir' ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['filter' => '30 Hari Terakhir']) }}">30 Hari Terakhir</a>
            </li>
        </ul>
    </div>
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
    <div class="col-md-12">
        <div class="row row-card row-deck">
            @foreach ($rancangans as $rancangan)
                <div class="col-xl-6">
                    <div class="card mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if ($rancangan->user->profilePhoto)
                                            <span class="avatar rounded-circle"
                                                style="background-image: url({{ Storage::url($rancangan->user->profilePhoto->photo_path) }})"></span>
                                        @else
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
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-column">
                                                <small>
                                                    <span class="strong">{{ $rancangan->user->name }}</span>
                                                </small>
                                                <small class="text-secondary">
                                                    <span>{{ $rancangan->created_at->diffForHumans() }} -
                                                        {{ $rancangan->created_at->translatedFormat('d F Y', 'id_ID') }}
                                                    </span>
                                                </small>
                                            </div>
                                            <small class="text-secondary">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
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
                                            <h3 class="lh-sm mb-2" onclick="showRancangan({{ $rancangan->id }})"
                                                style="cursor: pointer;">
                                                {{ $rancangan->jenis_kegiatan }}
                                            </h3>
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
                                            <h3 class="lh-sm mb-2" onclick="showRancangan({{ $rancangan->id }})"
                                                style="cursor: pointer;">
                                                {{ $rancangan->jenis_kegiatan }}
                                            </h3>
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
    </div>

    <!-- Pagination Links -->

    <div class="d-flex justify-content-center">
        {{ $rancangans->links('layouts.admin.custompagination') }}
    </div>
@endif

<div class="modal fade" id="rancanganModal" tabindex="-1" aria-labelledby="rancanganModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="rancanganModalLabel">Detail Todolist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="rancangan-image" class="img-fluid mb-3 rounded-3" src="" alt="Rancangan Image">
                <h3 id="jenis_kegiatan"></h3>
                <p id="pelaksanaan_kerja"></p>
                <span id="tempat" class="badge bg-azure text-white"></span>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function showRancangan(id) {
            axios.get(`/todolist/show/${id}`)
                .then(function(response) {
                    const rancangan = response.data;

                    // Set image source if foto exists
                    const imageElement = document.getElementById('rancangan-image');
                    if (rancangan.foto) {
                        const imageSrc = `/assets/images/${rancangan.foto}`;
                        imageElement.src = imageSrc;
                        imageElement.style.display = 'block';
                    } else {
                        imageElement.style.display = 'none';
                    }

                    // Set other data
                    document.getElementById('jenis_kegiatan').textContent = rancangan.jenis_kegiatan;
                    document.getElementById('pelaksanaan_kerja').textContent = rancangan.pelaksanaan_kerja;
                    document.getElementById('tempat').textContent = rancangan.tempat;

                    // Show modal
                    const modalElement = document.getElementById('rancanganModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        }
    </script>
@endpush
