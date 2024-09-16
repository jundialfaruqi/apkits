<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login | apkits</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <style>
        @import url('{{ asset('https://rsms.me/inter/inter.css') }}');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">

            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <a href="." class="navbar-brand navbar-brand-autodark">
                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"
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
                        apkits
                    </a>
                </h1>
                <h5 class="text-muted mb-0">Aplikasi Pelaporan Kegiatan IT Support</h5>
            </div>

            <form class="card card-md rounded-4" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Buat akun baru</h2>

                    <!-- name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" type="text" name="name"
                            class="form-control rounded-4 @error('name') is-invalid @enderror" placeholder="Nama"
                            autofocus autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email"
                            class="form-control rounded-4 @error('email') is-invalid @enderror" placeholder="Email"
                            autocomplete="username">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Pilih OPD -->
                    <div class="mb-3">
                        <label for="opd_id" class="form-label">OPD</label>
                        <select id="opd_id" name="opd_id"
                            class="form-select rounded-4 @error('opd_id') is-invalid @enderror">
                            <option value="" class="dorpdown-header" selected disabled>Pilih OPD</option>
                            @foreach ($opds as $opd)
                                <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
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

                    <!-- password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password"
                            class="form-control rounded-4 @error('password') is-invalid @enderror"
                            placeholder="Password" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- confirm password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control rounded-4 @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm password" autocomplete="Confirm password">

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100 rounded-4">Buat akun baru</button>
                    </div>

                </div>
            </form>

            <div class="text-center text-secondary mt-3">
                Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">Masuk</a>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>
