<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kangaroo Tracker</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/dx.light.css') }}">
    <link rel="stylesheet" href="{{ mix('css/sweetalert2.min.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body>
    @yield('body')
    @yield('scripts')
</body>
</html>
