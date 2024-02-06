@extends('layouts.main', ['title' => 'Welcome ' . session()->get('name')])

@section('content')
    <h1>
        Selamat datang {{ session()->get('role') }},
        {{ session()->get('name') }}
    </h1>
@endsection
