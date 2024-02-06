<div id="{{ $id }}" class="container-login" style="display: none">
    <center><b>{{ $title }}</b></center>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td width="25%"><b>{{ $label }}</b></td>
                <td width="25%" style="text-align: right">
                    <input type="text" name="{{ $name }}" required />
                </td>
            </tr>
            <tr>
                <td width="25%"><b>Password</b></td>
                <td width="25%" style="text-align: right">
                    <input type="password" name="password" required />
                </td>
            </tr>
        </table>

        <button type="submit" class="button-submit">Login</button>
    </form>
</div>
