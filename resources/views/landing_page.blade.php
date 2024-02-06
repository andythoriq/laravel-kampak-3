<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body>
    @include('partials.header')
    @include('partials.navbar')

    <div class="kiri-atas">
        <fieldset>
            <center>
                <button class="button-primary" onclick="tampilkan_login_admin()">Admin</button>
                <button class="button-primary" onclick="tampilkan_login_guru()">Teacher</button>
                <button class="button-primary" onclick="tampilkan_login_siswa()">Student</button>
                <hr />
                Choose your role
                <hr />
            </center>

            @include('partials.login_card', [
                'id' => 'login_admin',
                'title' => 'Login as Admin',
                'label' => 'ADMIN NUMBER',
                'name' => 'admin_number',
            ])

            @include('partials.login_card', [
                'id' => 'login_guru',
                'title' => 'Login as Teacher',
                'label' => 'NIP',
                'name' => 'nip',
            ])

            @include('partials.login_card', [
                'id' => 'login_siswa',
                'title' => 'Login as Student',
                'label' => 'NIS',
                'name' => 'nis',
            ])
        </fieldset>
    </div>

    <div class="kanan">
        <center>
            @include('partials.alert')
            <h1>
                SELAMAT DATANG <br /> Di Website Penilaian SMKN 1 Cibinong
            </h1>
        </center>
    </div>

    <div class="kiri-bawah">
        <center>
            <p class="mar"><b>Gallery</b></p>
            <div class="gallery">
                <img src="{{ asset('img/g2.jpg') }}" alt="gallery" />
                <div class="deskripsi">
                    SMK Bisa {{ env('APP_COPYRIGHT_YEAR', '2024') }}
                </div>
            </div>
        </center>
    </div>

    @include('partials.footer')
</body>

</html>
