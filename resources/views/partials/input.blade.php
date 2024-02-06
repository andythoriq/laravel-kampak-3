<label for="{{ $forId }}" style="text-align: left">{{ $label }}</label>
<input type="{{ $type }}" name="{{ $name }}" id="{{ $forId }}" value="{{ old($name, $old ?? '') }}"
    @required($isRequired ?? true) />
@error($name)
    <b><span style="color: red">{{ $message }}</span></b>
@enderror
