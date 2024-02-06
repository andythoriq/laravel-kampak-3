@extends('layouts.create', [
    'title' => 'Teacher',
    'url' => 'teachers',
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'nip',
    
        'label' => 'NIP',
        'name' => 'nip',
        'type' => 'number',
    ])

    @include('partials.input', [
        'forId' => 'name',
    
        'label' => 'NAME',
        'name' => 'name',
        'type' => 'text',
    ])

    @include('partials.gender_option')

    @include('partials.text_area', [
        'forId' => 'address',
    
        'name' => 'address',
    ])

    @include('partials.input', [
        'forId' => 'password',
    
        'label' => 'PASSWORD',
        'name' => 'password',
        'type' => 'password',
    ])
@endsection
