<!doctype html>
<html lang="en">

<!-- head -->
@include('layouts.admin.head')

<body>
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page" style="background: url(https://res.cloudinary.com/dxfq3iotg/image/upload/v1557323760/weather.svg) no-repeat center; background-size: cover;">

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <div class="page-wrapper">

            <!-- Navbar -->
            @include('layouts.admin.page-header')

            <!-- Page body -->
            @yield('content')

            {{-- footer blade --}}
            @include('layouts.admin.footer')

        </div>

    </div>

    @stack('js')

    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>
