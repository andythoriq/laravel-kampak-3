<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\M_Teacher;
use App\Models\M_Student;

class HomeController extends Controller
{
    private string $role = '';

    private string $name = '';

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (
            !(
                auth('admin')->check() ||
                auth('student')->check() ||
                auth('teacher')->check()
            )
        ) {
            return redirect()->route('landing');
        }

        if ($request->user('admin') instanceof Admin) {
            $this->name = $request->user('admin')->admin_number;
            $this->role = 'Admin';
        } else if ($request->user('student') instanceof M_Student) {
            $this->name = $request->user('student')->name;
            $this->role = 'Student';
        } else if ($request->user('teacher') instanceof M_Teacher) {
            $this->name = $request->user('teacher')->name;
            $this->role = 'Teacher';
        }

        session()->put('name', $this->name);
        session()->put('role', $this->role);

        return view('home');
    }
}
