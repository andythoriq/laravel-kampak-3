@extends('layouts.create', [
    'title' => 'Subject',
    'url' => 'subjects',
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'title',
    
        'label' => 'TITLE OF SUBJECT',
        'name' => 'title',
        'type' => 'text',
    ])
@endsection
