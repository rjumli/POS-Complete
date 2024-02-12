<!DOCTYPE html>
<html data-layout-mode="light" data-sidebar="dark" data-sidebar-image="none" data-layout-style="default" data-layout-position="fixed" data-sidebar-size="sm" data-topbar="light" data-layout-width="fluid" data-layout="vertical" data-preloader="disable" lang="" id="heady">
    @php $css_file = "css/app.css"; @endphp
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/css/bootstrap.css') }}" rel="stylesheet" />
        <link href="{{ mix('/css/icons.css') }}" rel="stylesheet" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <link rel="icon" href="{{ url('sei.ico') }}">
        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @inertiaHead
    </head>

    <body>
        @inertia
    </body>
</html>
