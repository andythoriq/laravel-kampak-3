@extends('layouts.edit', [
    'title' => 'Class',
    'url' => 'classes',
    'id' => $class->id,
])

@section('inputs')
    @include('partials.select2', [
        'label' => 'GRADE',
        'forId' => 'grade',
        'name' => 'grade',
        'data' => $grades,
        'old' => $class->grade,
    ])
    @include('partials.select2', [
        'label' => 'MAJOR',
        'forId' => 'major',
        'name' => 'major',
        'data' => $majors,
        'old' => $class->major,
    ])
    @include('partials.select2', [
        'label' => 'GROUP',
        'forId' => 'group',
        'name' => 'group',
        'data' => $groups,
        'old' => $class->group,
    ])
@endsection
