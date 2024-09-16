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
        @import url('https://rsms.me/inter/inter.css');

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
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center pb-5">
                            <h1 class="mb-0">
                                <a href="." class="navbar-brand navbar-brand-autodark">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
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

                        <div class="card card-md rounded-4">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Masuk ke akun anda</h2>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email"
                                            class="form-control rounded-4 @error('email') is-invalid @enderror"
                                            placeholder="your@email.com" name="email" :value="old('email')" autofocus
                                            autocomplete="username">
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-2">
                                        <label for="password" class="form-label">
                                            Password
                                            <span class="form-label-description">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">Lupa password</a>
                                                @endif
                                            </span>
                                        </label>
                                        <div class="input-group input-group-flat rounded-4">
                                            <input id="password" type="password"
                                                class="form-control rounded-start-4 @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password" autocomplete="current-password">
                                            <span class="input-group-text rounded-end-4">
                                                <button type="button" id="toggle-password" class="switch-icon"
                                                    title="Show password" data-bs-toggle="switch-icon">
                                                    <span class="switch-icon-a text-secondary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-closed">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" />
                                                            <path d="M3 15l2.5 -3.8" />
                                                            <path d="M21 14.976l-2.492 -3.776" />
                                                            <path d="M9 17l.5 -4" />
                                                            <path d="M15 17l-.5 -4" />
                                                        </svg>
                                                    </span>
                                                    <span class="switch-icon-b text-facebook">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </span>
                                            @error('password')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Remember me -->
                                    {{-- <div class="mb-2">
                                        <label for="remember_me" class="form-check">
                                            <input id="remember_me" type="checkbox" class="form-check-input rounded-3"
                                                name="remember" />
                                            <span class="form-check-label">Remember me on this device</span>
                                        </label>
                                    </div> --}}

                                    <!-- Submit -->
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100 rounded-4">Masuk
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="text-center text-secondary mt-3">
                            Belum punya akun? <a href="{{ route('register') }}" tabindex="-1">Daftar</a>
                        </div>
                        <!-- Tambahkan script ini di bawah -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const togglePassword = document.getElementById('toggle-password');
                                const passwordField = document.getElementById('password');

                                togglePassword.addEventListener('click', function() {
                                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                                    passwordField.setAttribute('type', type);
                                    this.title = type === 'password' ? 'Show password' : 'Hide password';
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('static/illustrations/undraw_secure_login_pdn4.svg') }}" height="300"
                        class="d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>
