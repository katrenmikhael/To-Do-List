<html>

<head>
    <title> Notes </title>
    <link rel="stylesheet" href="{{ URL::asset('./css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('./css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('./css/style.css') }}">
</head>

<body>


    @extends('layout.navbar')

    <div class="container mt-5 pt-5">
        @yield('content')
    </div>
    <div class="footer position-absolute bottom-0">
        @extends('layout.footer')
    </div>
    <script src="{{ URL::asset('./js/all.min.js') }}"></script>
    <script src="{{ URL::asset('./js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('./js/main.js') }}"></script>
</body>

</html>
