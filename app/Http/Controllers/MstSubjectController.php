<?php

namespace App\Http\Controllers;

use App\Models\M_Subject as Subject;
use App\Models\Trx_Teaching;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MstSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::select(['id', 'title'])->orderBy('title')->get();

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:32', Rule::unique('m_subjects', 'title')],
        ]);

        try {
            Subject::create($data);
            return redirect()->route('subjects.index')->with('success', 'Create Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Create Fail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'title' => ['required', 'max:32', Rule::unique('m_subjects', 'title')->ignore($subject->id, 'id')],
        ]);

        try {
            $subject->updateOrFail($data);
            return redirect()->route('subjects.index')->with('success', 'Update Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Update Fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if (Trx_Teaching::where('subject_id', $subject->id)->exists()) {
            return back()->with('danger', "{$subject->title} is in used");
        }

        try {
            $subject->deleteOrFail();
            return redirect()->route('subjects.index')->with('success', 'Delete Success');
        } catch (\Throwable $th) {
            return back()->with('danger', 'Delete Fail');
        }
    }
}
