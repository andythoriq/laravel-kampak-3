@extends('layouts.edit', [
    'title' => 'Student',
    'url' => 'students',
    'id' => $student->id,
])

@section('inputs')
    @include('partials.input', [
        'forId' => 'nis',
    
        'label' => 'NIS',
        'name' => 'nis',
        'type' => 'number',
        'old' => $student->nis,
    ])

    @include('partials.input', [
        'forId' => 'name',
    
        'label' => 'NAME',
        'name' => 'name',
        'type' => 'text',
        'old' => $student->name,
    ])

    @include('partials.gender_option', ['old' => $student->gender])

    @include('partials.select', [
        'data' => $classes,
        'forId' => 'class_id',
        'item_key_name' => 'class',
        'label' => 'Class',
        'name' => 'class_id',
        'old' => $student->class_id,
    ])

    @include('partials.text_area', [
        'forId' => 'address',
    
        'name' => 'address',
        'old' => $student->address,
    ])

    @include('partials.input', [
        'forId' => 'new_password',
        'isRequired' => false,
        'label' => 'NEW PASSWORD',
        'name' => 'new_password',
        'type' => 'password',
    ])

    <input name="password" value="{{ $student->password }}" hidden />
@endsection
