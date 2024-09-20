<!doctype html>
<html lang="en">

<!-- head -->
@include('layouts.admin.head')

<body>

    @include('layouts.admin.toast')

    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">

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
