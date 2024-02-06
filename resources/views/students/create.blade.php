@extends('layouts.create', [
    'title' => 'Student',
    'url' => 'students',
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'nis',
    
        'label' => 'NIS',
        'name' => 'nis',
        'type' => 'number',
    ])

    @include('partials.input', [
        'forId' => 'name',
    
        'label' => 'NAME',
        'name' => 'name',
        'type' => 'text',
    ])

    @include('partials.gender_option')

    @include('partials.select', [
        'data' => $classes,
        'forId' => 'class_id',
        'item_key_name' => 'class',
        'label' => 'Class',
        'name' => 'class_id',
    ])

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
