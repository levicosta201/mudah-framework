<!doctype html>
<html lang="en">
<head>
    @include('static.head')
    @yield('css')
</head>

<body class="text-center">
@yield('content')
@include('static.footer')
@yield('js')
</body>
</html>
