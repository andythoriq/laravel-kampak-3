<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\M_Student;
use App\Models\M_Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private string $guard_name = '';

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (isset($request->admin_number)) {
            $attr = Admin::
                select(['id', 'admin_number', 'password'])->
                where('admin_number', $request->admin_number)->
                first();
            $this->guard_name = 'admin';
        } else if (isset($request->nis)) {
            $attr = M_Student::
                select(['id', 'nis', 'password'])->
                where('nis', $request->nis)->
                first();
            $this->guard_name = 'student';
        } else if (isset($request->nip)) {
            $attr = M_Teacher::
                select(['id', 'nip', 'password'])->
                where('nip', $request->nip)->
                first();
            $this->guard_name = 'teacher';
        }

        if (!$attr || !Hash::check($request->password, $attr->password)) {
            return back()->with('danger', 'Your account does not found in our database.');
        }

        Auth::guard($this->guard_name)->login($attr);

        return redirect()->route('home')->with('success', 'Login Success');
    }
}
