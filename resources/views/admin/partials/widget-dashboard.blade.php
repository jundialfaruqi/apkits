<div class="row justify-content-center">
    <div class="col-md-4 mb-3">

        <div class="card d-flex flex-column rounded-4 bg-transparent shadow-sm no-repeat bg-cover"
            style="background-image: url(https://res.cloudinary.com/dxfq3iotg/image/upload/v1557323760/weather.svg)">
            <div class="row row-0 flex-fill">
                <div class="col">
                    <div class="card-body rounded-4">
                        <h2 class="mb-2"><a href="#">Selamat Datang</a></h2>
                        @role('super-admin')
                            <p class="text-secondary">Di <b>APKITS</b>, Aplikasi Pelaporan Kegiatan IT Support
                                dan THL Pemerintah Kota Pekanbaru V.1.0</p>
                        @endrole
                        @role('it-support|admin|thl|staff|kabid|kadis')
                            <p class="text-secondary">Di <b>APKITS</b>, Aplikasi Pelaporan Kegiatan IT Support
                                dan THL {{ Auth::user()->opd->name }} Kota Pekanbaru</p>
                        @endrole
                        <div class="d-flex align-items-center mt-auto">
                            <div>
                                <a href="#"
                                    class="text-body me-1 btn btn-sm bg-azure-lt rounded-4 shadow-sm py-2 px-2 mb-1">Bantuan</a>
                                <a href="#"
                                    class="text-body btn btn-sm bg-gray-50 rounded-4 shadow-sm py-2 px-2 mb-1">Tentang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card d-flex flex-column rounded-4 bg-transparent shadow-sm">
            <div class="row row-0 flex-fill">
                <div class="col">
                    <div class="card-body">
                        <h2 class="mb-2"><a href="#">Selamat Datang</a></h2>
                        @role('super-admin')
                            <p class="text-secondary">Di <b>APKITS</b>, Aplikasi Pelaporan Kegiatan IT Support
                                dan THL Pemerintah Kota Pekanbaru V.1.0</p>
                        @endrole

                        @role('it-support|admin|thl|staff|kabid|kadis')
                            <p class="text-secondary">Di <b>APKITS</b>, Aplikasi Pelaporan Kegiatan IT Support
                                dan THL {{ Auth::user()->opd->name }} Kota Pekanbaru</p>
                        @endrole
                        <div class="d-flex align-items-center mt-auto">
                            <div>
                                <a href="#"
                                    class="text-body me-1 btn btn-sm bg-azure-lt rounded-4 shadow-sm py-2 px-2 mb-1">Bantuan</a>
                                <a href="#"
                                    class="text-body btn btn-sm bg-gray-50 rounded-4 shadow-sm py-2 px-2 mb-1">Tentang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="col-md-8 mb-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-azure-lt text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        THL
                                    </div>
                                    <div class="text-secondary">
                                        {{ $thlCount }} Orang
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-azure-lt text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        IT Support
                                    </div>
                                    <div class="text-secondary">
                                        {{ $itCount }} Orang
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-azure-lt text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M18.5 18.5l2.5 2.5" />
                                            <path d="M4 6h16" />
                                            <path d="M4 12h4" />
                                            <path d="M4 18h4" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Hari Ini
                                    </div>
                                    <div class="text-secondary">
                                        {{ $totalRancangansToday }} kagiatan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-azure-lt text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Bulan Ini
                                    </div>
                                    <div class="text-secondary">
                                        {{ $totalRancangansMounth }} Kegiatan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-sm mb-3 border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-azure-lt text-white avatar rounded-circle"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-mist">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 5h3m4 0h9" />
                                            <path d="M3 10h11m4 0h1" />
                                            <path d="M5 15h5m4 0h7" />
                                            <path d="M3 20h9m4 0h3" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Semua
                                    </div>
                                    <div class="text-secondary">
                                        {{ $totalRancangans }} Kegiatan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
