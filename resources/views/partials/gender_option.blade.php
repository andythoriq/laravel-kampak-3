<label style="text-align: left">Gender</label>
<div style="margin-bottom: 8px; text-align: left">
    <input @required($isRequired ?? true) type="radio" name="gender" value="L" id="gender_M" @checked(old('gender', $old ?? '') == 'L') />
    <label style="display: inline" for="gender_M">Male</label>
    <input type="radio" name="gender" value="P" id="gender_F" @checked(old('gender', $old ?? '') == 'P') /> <label
        style="display: inline" for="gender_F">Female</label>
</div>
@error('gender')
    <br><span style="color: red">{{ $message }}</span>
@enderror
