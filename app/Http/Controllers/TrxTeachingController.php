<?php

namespace App\Http\Controllers;

use App\Models\M_Class;
use App\Models\M_Subject;
use App\Models\M_Teacher;
use App\Models\Trx_Teaching as Teaching;
use App\Models\Trx_Teaching;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrxTeachingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachings = Trx_Teaching::
            select([
                'trx_teachings.id',
                'm_subjects.title as subject',
                \DB::raw("CONCAT(m_teachers.name,'-',m_teachers.nip) as teacher"),
                \DB::raw("CONCAT(m_classes.grade,' ',m_classes.major,' ',m_classes.group) as class")
            ])->
            join('m_teachers', 'm_teachers.id', '=', 'teacher_id')->
            join('m_subjects', 'm_subjects.id', '=', 'subject_id')->
            join('m_classes', 'm_classes.id', '=', 'class_id')->
            get();

        return view('teachings.index', compact('teachings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachings.create', [
            'classes' => M_Class::get_classes(),
            'subjects' => M_Subject::get_subjects(),
            'teachers' => M_Teacher::get_teachers(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'teacher_id' => ['required', Rule::exists('m_teachers', 'id')],
            'subject_id' => ['required', Rule::exists('m_subjects', 'id')],
            'class_id' => ['required', Rule::exists('m_classes', 'id')],
        ]);

        if (
            Trx_Teaching::
                where('teacher_id', $data['teacher_id'])->
                where('subject_id', $data['subject_id'])->where('class_id', $data['class_id'])->exists()
        ) {
            return back()->with('danger', 'Teaching is already exists');
        }

        if (
            Trx_Teaching::where('subject_id', $data['subject_id'])->
                where('class_id', $data['class_id'])->exists()
        ) {
            return back()->with('danger', 'Class and Subject are used');
        }

        try {
            Trx_Teaching::create($data);
            return redirect()->route('teachings.index')->with('success', 'Create Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Create Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teaching $teaching)
    {
        return view('teachings.edit', [
            'teaching' => $teaching,
            'classes' => M_Class::get_classes(),
            'subjects' => M_Subject::get_subjects(),
            'teachers' => M_Teacher::get_teachers(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teaching $teaching)
    {
        return view('teachings.edit', [
            'teaching' => $teaching,
            'classes' => M_Class::get_classes(),
            'subjects' => M_Subject::get_subjects(),
            'teachers' => M_Teacher::get_teachers(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teaching $teaching)
    {
        $data = request()->validate([
            'teacher_id' => ['required', Rule::exists('m_teachers', 'id')],
            'subject_id' => ['required', Rule::exists('m_subjects', 'id')],
            'class_id' => ['required', Rule::exists('m_classes', 'id')],
        ]);

        if (
            $data['teacher_id'] != $teaching->teacher_id ||
            $data['subject_id'] != $teaching->subject_id ||
            $data['class_id'] != $teaching->class_id
        ) {
            if (
                Trx_Teaching::
                    where('teacher_id', $data['teacher_id'])->
                    where('subject_id', $data['subject_id'])->where('class_id', $data['class_id'])->exists()
            ) {
                return back()->with('danger', 'Teaching is already exists');
            }

            if (
                Trx_Teaching::where('subject_id', $data['subject_id'])->
                    where('class_id', $data['class_id'])->exists()
            ) {
                return back()->with('danger', 'Class and Subject are used');
            }
        }

        try {
            $teaching->updateOrFail($data);
            return redirect()->route('teachings.index')->with('success', 'Update Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Update Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teaching $teaching)
    {
        try {
            $teaching->deleteOrFail();
            return redirect()->route('teachings.index')->with('success', 'Delete Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Delete Fail');
        }
    }
}
