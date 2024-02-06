@extends('layouts.main', ['title' => $title . ' - Edit'])

@section('content')
    <div class="container-form">
        <h2 align="center">{{ $title }} Edit Form</h2>

        <form action="{{ route("$url.update", $id) }}" method="post" autocomplete="off">
            @csrf
            @method('PUT')

            @yield('inputs')

            <button type="submit" class="button-submit">UPDATE</button>
        </form>
    </div>
@endsection
