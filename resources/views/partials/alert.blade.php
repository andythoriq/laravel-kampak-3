@if (session()->has('success'))
    <div class="alert alert-success">
        <span class="closebtn" id="closeBtn">&times;</span>
        <b>{{ session()->get('success') }}</b>
    </div>
@elseif (session()->has('danger'))
    <div class="alert alert-danger">
        <span class="closebtn" id="closeBtn">&times;</span>
        <b>{{ session()->get('danger') }}</b>
    </div>
@endif
