<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ env('APP_NAME', 'Penilaian Siswa') }}{{ ' - ' . $title }}</title>
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body>
    @include('partials.header')
    @include('partials.navbar')

    <div class="content">
        <center>
            @include('partials.alert')
            @yield('content')
        </center>
    </div>

    @include('partials.footer')
</body>

</html>
