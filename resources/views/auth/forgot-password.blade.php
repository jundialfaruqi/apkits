<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forgot password | apkits</title>
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
            <form class="card card-md rounded-4" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Forgot password</h2>
                    <p class="text-secondary mb-4">Enter your email address and your password will be reset and emailed
                        to you.</p>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" type="email" name="email" autofocus
                            class="form-control rounded-4 @error('email') is-invalid @enderror"
                            placeholder="Enter email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="form-footer">
                        <button class="btn btn-primary w-100 rounded-4">
                            <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                            Send me new password
                        </button>
                    </div>

                </div>
            </form>

            <div class="text-center text-secondary mt-3">
                Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>
