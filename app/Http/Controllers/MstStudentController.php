<?php

namespace App\Http\Controllers;

use App\Models\M_Class;
use App\Models\M_Student as Student;
use App\Models\Trx_Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MstStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::
            select([
                'm_students.id',
                'nis',
                'name',
                'address',
                \DB::raw("(CASE WHEN gender='L' THEN 'Laki-laki' ELSE 'Perempuan' END) as gender"),
                \DB::raw("CONCAT(m_classes.grade,' ',m_classes.major,' ',m_classes.group) as class")
            ])->
            orderBy('name')->
            join('m_classes', 'm_classes.id', '=', 'class_id')->
            get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = M_Class::get_classes();
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('m_students', 'nis')],
            'name' => ['required', 'min:3', 'max:32'],
            'gender' => ['required', 'in:P,L'],
            'address' => ['required'],
            'class_id' => ['required', Rule::exists('m_classes', 'id')],
            'password' => ['required', Password::default()],
        ]);

        $data['password'] = Hash::make($data['password']);

        try {
            Student::create($data);
            return redirect()->route('students.index')->with('success', 'Create Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Create Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = M_Class::get_classes();
        return view('students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nis' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('m_students', 'nis')->ignore($student->id, 'id')],
            'name' => ['required', 'min:3', 'max:32'],
            'gender' => ['required', 'in:P,L'],
            'address' => ['required'],
            'password' => ['required'],
        ]);

        if (!is_null($request->new_password)) {
            $data['password'] = Hash::make($request->new_password);
        }

        try {
            $student->updateOrFail($data);
            return redirect()->route('students.index')->with('Update Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Update Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if (Trx_Assessment::where('student_id', $student->id)->exists()) {
            return back()->with('danger', "{$student->name} is in used");
        }

        try {
            $student->deleteOrFail();
            return redirect()->route('students.index')->with('Delete Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Delete Fail');
        }
    }
}
