<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | apkits</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />

    <!-- Link CSS untuk DataTables -->
    <link rel="stylesheet" href="{{ asset('dist/css/datatables.css') }}">

    <!-- Script untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Script untuk DataTables -->
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
        #toast-container {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 1050;
        }
        .toast {
            max-width: 350px;
            overflow: hidden;
            font-size: 0.875rem;
            background-color: rgba(255, 255, 255, 0.85);
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            opacity: 0;
            border-radius: 0.25rem;
            transform: translateY(-100%);
            transition: all 0.25s ease-out;
        }
        .toast.showing {
            opacity: 1;
            transform: translateY(0%);
        }
        .toast.show {
            display: block;
            opacity: 1;
            transform: translateY(0%);
        }
        .toast.hide {
            display: none;
            transform: translateY(-100%);
        }

    </style>

    @stack('css')
</head>
