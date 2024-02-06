@extends('layouts.create', [
    'title' => 'Teaching',
    'url' => 'teachings',
])

@section('inputs')
    @include('partials.select', [
        'label' => 'TEACHER',
        'name' => 'teacher_id',
        'forId' => 'teacher',
        'data' => $teachers,
        'item_key_name' => 'teacher',
    ])

    @include('partials.select', [
        'label' => 'SUBJECT',
        'name' => 'subject_id',
        'forId' => 'subject',
        'data' => $subjects,
        'item_key_name' => 'title',
    ])

    @include('partials.select', [
        'label' => 'CLASS',
        'name' => 'class_id',
        'forId' => 'class',
        'data' => $classes,
        'item_key_name' => 'class',
    ])
@endsection
