<?php

namespace App\Http\Controllers;

use App\Models\Trx_Teaching;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\M_Teacher as Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MstTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::
            select([
                'id',
                'nip',
                'name',
                'address',
                \DB::raw("(CASE WHEN gender='L' THEN 'Laki-laki' ELSE 'Perempuan' END) as gender"),
            ])->
            orderBy('name')->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('m_teachers', 'nip')],
            'name' => ['required', 'min:3', 'max:32'],
            'gender' => ['required', 'in:P,L'],
            'address' => ['required'],
            'password' => ['required', Password::default()],
        ]);

        $data['password'] = Hash::make($data['password']);

        try {
            Teacher::create($data);
            return redirect()->route('teachers.index')->with('success', 'Create Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Create Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'nip' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('m_teachers', 'nip')->ignore($teacher->id, 'id')],
            'name' => ['required', 'min:3', 'max:32'],
            'gender' => ['required', 'in:P,L'],
            'address' => ['required'],
            'password' => ['required'],
        ]);

        if (!is_null($request->new_password)) {
            $data['password'] = Hash::make($request->new_password);
        }

        try {
            $teacher->updateOrFail($data);
            return redirect()->route('teachers.index')->with('Update Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Update Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if (Trx_Teaching::where('teacher_id', $teacher->id)->exists()) {
            return back()->with('danger', "{$teacher->name} is in used");
        }

        try {
            $teacher->deleteOrFail();
            return redirect()->route('teachers.index')->with('Delete Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Delete Fail');
        }
    }
}
