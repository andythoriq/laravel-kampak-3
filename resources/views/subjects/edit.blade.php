@extends('layouts.edit', [
    'title' => 'Subject',
    'url' => 'subjects',
    'id' => $subject->id,
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'title',
        'label' => 'TITLE OF SUBJECT',
        'name' => 'title',
        'type' => 'text',
        'old' => $subject->title,
    ])
@endsection
