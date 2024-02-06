<?php

namespace App\Http\Controllers;

use App\Models\M_Class;
use App\Models\M_Student;
use App\Models\Trx_Teaching;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MstClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = M_Class::get_classes();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create', [
            'grades' => M_Class::$grades,
            'majors' => M_Class::$majors,
            'groups' => M_Class::$groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'grade' => ['required', Rule::in(M_Class::$grades)],
            'major' => ['required', Rule::in(M_Class::$majors)],
            'group' => ['required', Rule::in(M_Class::$groups)],
        ]);

        if (
            M_Class::
                where('grade', $data['grade'])->
                where('major', $data['major'])->
                where('group', $data['group'])->exists()
        ) {
            return back()->with('danger', 'Class is already exists');
        }

        try {
            M_Class::create($data);
            return redirect()->route('classes.index')->with('success', 'Create Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Create Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(M_Class $class)
    {
        return view('classes.edit', [
            'class' => $class,
            'grades' => M_Class::$grades,
            'majors' => M_Class::$majors,
            'groups' => M_Class::$groups,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(M_Class $class)
    {
        return view('classes.edit', [
            'class' => $class,
            'grades' => M_Class::$grades,
            'majors' => M_Class::$majors,
            'groups' => M_Class::$groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, M_Class $class)
    {
        $data = $request->validate([
            'grade' => ['required', Rule::in(M_Class::$grades)],
            'major' => ['required', Rule::in(M_Class::$majors)],
            'group' => ['required', Rule::in(M_Class::$groups)],
        ]);

        if (
            $data['grade'] != $class->grade ||
            $data['major'] != $class->major ||
            $data['group'] != $class->group
        ) {
            if (
                M_Class::
                    where('grade', $data['grade'])->
                    where('major', $data['major'])->
                    where('group', $data['group'])->exists()
            ) {
                return back()->with('danger', 'Class is Already Exists');
            }
        }

        try {
            $class->updateOrFail($data);
            return redirect()->route('classes.index')->with('success', 'Update Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Update Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(M_Class $class)
    {
        if (M_Student::where('class_id', $class->id)->exists()) {
            return back()->with('danger', 'Class is in used (students)');
        }

        if (Trx_Teaching::where('class_id', $class->id)->exists()) {
            return back()->with('danger', 'Class is in used (teachings)');
        }

        try {
            $class->deleteOrFail();
            return redirect()->route('classes.index')->with('success', 'Delete Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Delete Fail');
        }
    }
}
