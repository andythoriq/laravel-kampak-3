@extends('layouts.main', ['title' => $title . ' - Create'])

@section('content')
    <div class="container-form">
        <h2 align="center">{{ $title }} Create Form</h2>

        <form action="{{ route("$url.store") }}" method="post" autocomplete="off">
            @csrf

            @yield('inputs')

            <button type="submit" class="button-submit">STORE</button>
        </form>
    </div>
@endsection
