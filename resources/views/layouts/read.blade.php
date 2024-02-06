@extends('layouts.main', ['title' => $title])

@section('content')
    <?php
    if ($data->count() > 0) {
        $columns = array_filter(array_keys($data[0]->toArray()), fn($val) => $val != 'id');
    } else {
        $columns = ['(add new data)'];
    }
    ?>
    <h2>{{ $title }}</h2>

    <a href="{{ route("$url.create") }}" class="button-primary">ADD DATA</a>

    <table class="table-data">
        <thead>
            <tr>
                <th>NO</th>
                @foreach ($columns as $column)
                    <th>{{ strtoupper($column) }}</th>
                @endforeach
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @foreach ($columns as $column)
                        <td>{{ $item[$column] }}</td>
                    @endforeach
                    <td style="text-align: center">
                        <a href="{{ route("$url.edit", $item->id) }}" class="button-warning">EDIT</a>
                        <form action="{{ route("$url.destroy", $item->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-danger"
                                onclick="return confirm('You Sure?')">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
