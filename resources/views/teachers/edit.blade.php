@extends('layouts.edit', [
    'title' => 'Teacher',
    'url' => 'teachers',
    'id' => $teacher->id,
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'nip',
        'label' => 'NIP',
        'name' => 'nip',
        'type' => 'number',
        'old' => $teacher->nip,
    ])

    @include('partials.input', [
        'forId' => 'name',
        'label' => 'NAME',
        'name' => 'name',
        'type' => 'text',
        'old' => $teacher->name,
    ])

    @include('partials.gender_option', ['old' => $teacher->gender])

    @include('partials.text_area', [
        'forId' => 'address',
    
        'name' => 'address',
        'old' => $teacher->address,
    ])

    @include('partials.input', [
        'forId' => 'new_password',
        'isRequired' => false,
        'label' => 'NEW PASSWORD',
        'name' => 'new_password',
        'type' => 'password',
    ])

    <input name="password" value="{{ $teacher->password }}" hidden />
@endsection
