<!doctype html>
<html lang="en">

<head>
    <title>DINAS PERHUBUNGAN KAB-OKI</title>
    <link rel="icon" href="{{ asset('img/dishub.png') }}">
    @include('layouts.sections.header')
</head>

<body class="my_bg">
    <script src="{{ asset('tabler.io/dist/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page">
        @include('layouts.sections.header')
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @include('layouts.sections.footer')
        </div>
    </div>
</body>

</html>