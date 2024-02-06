@extends('layouts.create', [
    'title' => 'Class',
    'url' => 'classes',
])

@section('inputs')
    @include('partials.select2', [
        'label' => 'GRADE',
        'forId' => 'grade',
        'name' => 'grade',
        'data' => $grades,
    ])
    @include('partials.select2', [
        'label' => 'MAJOR',
        'forId' => 'major',
        'name' => 'major',
        'data' => $majors,
    ])
    @include('partials.select2', [
        'label' => 'GROUP',
        'forId' => 'group',
        'name' => 'group',
        'data' => $groups,
    ])
@endsection
