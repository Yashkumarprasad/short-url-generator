<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ FIRM_NAME }} @if (isset($title) && !empty($title))
        | {{ $title }}
    @endif
    </title>

    @if (Auth::guard('admin')->user())
        <!-- plugins:css -->
        <link href="{{ assets_url('css', 'bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"
            media="screen" />
        <link href="{{ assets_url('css', 'ajax.bootstrap.min.css') }}" rel="stylesheet">
        <script>
            var BASE_URL = '<?php    echo url('/'); ?>';
        </script>
    @endif
    <link rel="stylesheet" href="{{ assets_url('css', 'font-awesome.css') }}">

    <link rel="stylesheet" href="{{ assets_url('css', 'style.css??v=5.0') }}">

    <link href="{{ assets_url('vendors/mdi/css', 'materialdesignicons.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ assets_url('images', 'favicon.ico') }}" />
</head>

<body>
    @if (Auth::guard('admin')->user())
        <div class="container-scroller" id="user_data">
            @include('admin.includes.header')
            <div class="container-fluid page-body-wrapper">
                @include('admin.includes.sidebar')
                @yield('content')
            </div>
        </div>
        <script src="{{ assets_url('js', 'jquery.min.js') }}"></script>
        <script src="{{ assets_url('js', 'jquery-ui.min.js') }}"></script>

        <script src="{{ assets_url('js', 'hoverable-collapse.js') }}"></script>
        <script src="{{ assets_url('js', 'misc.js') }}"></script>

        <script src="{{ assets_url('js', 'off-canvas.js') }}"></script>

        <!-- endinject -->

        <script type="text/javascript">
            setTimeout('$("#errorBlock").fadeOut();', 5000);
            setTimeout('$(".alert-danger").fadeOut();', 5000);
        </script>
    @else
        @yield('content')
        <script src="{{ assets_url('js', 'jquery.min.js') }}"></script>
    @endif

    <script src="{{ assets_url('js', 'bootstrap.bundle.min.js') }}"></script>
    <script src="{{ assets_url('js', 'formValidation.min.js') }}"></script>
    <script src="{{ assets_url('js', 'Customjs.js?v=1.2') }}"></script>
    @yield('scripts')
</body>

</html>