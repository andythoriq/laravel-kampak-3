<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrxAssessmentController extends Controller
{
    public function student()
    {

    }

    public function index_class()
    {
        return view('assessments.class.index');
    }

    public function show_class()
    {
        return view('assessments.class.show');
    }
}
