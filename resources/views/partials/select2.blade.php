<label for="{{ $forId }}" style="text-align: left">{{ $label }}</label>
<select name="{{ $name }}" id="{{ $forId }}" @required($isRequired ?? true)>
    <option value="">-- choosse {{ $label }} --</option>
    @foreach ($data as $item)
        <option value="{{ $item }}" @selected(old($name, $old ?? '') == $item)>{{ $item }}</option>
    @endforeach
</select>
@error($name)
    <br><span style="color: red">{{ $message }}</span>
@enderror
