<aside class="navbar navbar-vertical navbar-expand-lg sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark pb-0 pt-3">
            <a href="{{ route('dashboard') }}">
                <div class="navbar-brand-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                        <path d="M2 13.5v5.5l5 3" />
                        <path d="M7 16.545l5 -3.03" />
                        <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                        <path d="M12 19l5 3" />
                        <path d="M17 16.5l5 -3" />
                        <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                        <path d="M7 5.03v5.455" />
                        <path d="M12 8l5 -3" />
                    </svg>
                    <span class="">apkits</span>
                </div>
            </a>
        </h1>
        <h6 class="text-center d-none d-xl-block">Aplikasi Pelaporan Kegiatan IT Support</h6>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="d-none d-lg-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                        </svg>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-secondary">{{ Auth::user()->role }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile Setting</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                              this.closest('form').submit();"
                            class="dropdown-item">
                            Logout </a>

                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M13.45 11.55l2.05 -2.05" />
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                @can('view statistik')
                    <li class="nav-item {{ Request::route()->getName() == 'statistik.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statistik.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M4 20h14" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Statistik
                            </span>
                        </a>
                    </li>
                @endcan
                @role('super-admin|admin')
                    <li class="dropdown-header hr-text mb-1 mt-3">Admin </li>
                    <li
                        class="nav-item dropdown {{ Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/permissions') || Request::is('admin/users') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-lock-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" />
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Roles and Permissions
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/permissions') || Request::is('admin/users') ? 'show' : '' }}">
                            @role('super-admin')
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/roles') ? 'active' : '' }}"
                                    href="{{ route('roles.index') }}">
                                    Roles
                                </a>
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/permissions') ? 'active' : '' }}"
                                    href="{{ route('permissions.index') }}">
                                    Permissions
                                </a>
                            @endrole
                            @role('super-admin|admin')
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/users') ? 'active' : '' }}"
                                    href="{{ route('user.index') }}">
                                    Users
                                </a>
                            @endrole
                        </div>
                    </li>
                @endrole

                @role('super-admin|admin')
                    <li
                        class="nav-item dropdown {{ Request::is('admin/kegiatan') || Request::is('admin/semua-data-todolist') || Request::is('admin/kegiatan/create') || Request::is('admin/opd') || Request::is('admin/pekerjaan') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Data Kegitatan
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ Request::is('admin/kegiatan') || Request::is('admin/semua-data-todolist') || Request::is('admin/kegiatan/create') || Request::is('admin/opd') || Request::is('admin/pekerjaan') ? 'show' : '' }}">
                            @can('view kegiatan')
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/kegiatan') || Request::is('admin/kegiatan/create') ? 'active' : '' }}"
                                    href="{{ route('kegiatan.index') }}">
                                    Kegiatan
                                </a>
                            @endcan
                            @role('super-admin|admin')
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/semua-data-todolist') ? 'active' : '' }}"
                                    href="{{ route('semuadatatodolist') }}">
                                    Semua Data Todolist
                                </a>
                            @endrole
                            @role('super-admin')
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/pekerjaan') ? 'active' : '' }}"
                                    href="{{ route('pekerjaan.index') }}">
                                    Pekerjaan
                                </a>
                                <a class="dropdown-item rounded-end-pill {{ Request::is('admin/opd') ? 'active' : '' }}"
                                    href="{{ route('opd.index') }}">
                                    OPD
                                </a>
                            @endrole
                        </div>
                    </li>
                @endrole

                @role('super-admin|admin')
                    <li class="nav-item {{ Request::route()->getName() == 'formatlaporan.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('formatlaporan.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-tools">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" />
                                    <path d="M14.5 5.5l4 4" />
                                    <path d="M12 8l-5 -5l-4 4l5 5" />
                                    <path d="M7 8l-1.5 1.5" />
                                    <path d="M16 12l5 5l-4 4l-5 -5" />
                                    <path d="M16 17l-1.5 1.5" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Format Laporan
                            </span>
                        </a>
                    </li>
                @endrole

                @can('view todolist')
                    <li class="dropdown-header hr-text mb-1 mt-3">Menu </li>
                    <li class="nav-item {{ Request::route()->getName() == 'todolist' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('todolist') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M13 5h8" />
                                    <path d="M13 9h5" />
                                    <path d="M13 15h8" />
                                    <path d="M13 19h5" />
                                    <path
                                        d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Todolist
                            </span>
                        </a>
                    </li>
                @endcan

                @canany(['view kesimpulan', 'view all kesimpulan'])
                    <li class="nav-item {{ Request::route()->getName() == 'kesimpulan.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kesimpulan.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-pencil">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Kesimpulan Laporan
                            </span>
                        </a>
                    </li>
                @endcanany

                @can('view laporan')
                    <li class="nav-item {{ Request::route()->getName() == 'todolist.laporan' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('todolist.laporan') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-report-analytics">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path
                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 17v-5" />
                                    <path d="M12 17v-1" />
                                    <path d="M15 17v-3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Rekap Laporan Bulanan
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</aside>
