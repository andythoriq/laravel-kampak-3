@extends('layouts.edit', [
    'title' => 'Teaching',
    'url' => 'teachings',
    'id' => $teaching->id,
])

@section('inputs')
    @include('partials.select', [
        'label' => 'TEACHER',
        'name' => 'teacher_id',
        'forId' => 'teacher',
        'data' => $teachers,
        'item_key_name' => 'teacher',
        'old' => $teaching->teacher_id,
    ])

    @include('partials.select', [
        'label' => 'SUBJECT',
        'name' => 'subject_id',
        'forId' => 'subject',
        'data' => $subjects,
        'item_key_name' => 'title',
        'old' => $teaching->subject_id,
    ])

    @include('partials.select', [
        'label' => 'CLASS',
        'name' => 'class_id',
        'forId' => 'class',
        'data' => $classes,
        'item_key_name' => 'class',
        'old' => $teaching->class_id,
    ])
@endsection
