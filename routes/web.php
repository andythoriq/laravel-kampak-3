<?php

use App\Http\Controllers\MstClassController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MstStudentController;
use App\Http\Controllers\MstSubjectController;
use App\Http\Controllers\MstTeacherController;
use App\Http\Controllers\TrxAssessmentController;
use App\Http\Controllers\TrxTeachingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
})->name('landing');

Route::get('/home', HomeController::class)->name('home');

Route::middleware('auth:admin')->group(function () {

    Route::resources([
        'teachers' => MstTeacherController::class,
        'students' => MstStudentController::class,
        'subjects' => MstSubjectController::class,
        'classes' => MstClassController::class,
        'teachings' => TrxTeachingController::class,
    ]);

});

Route::middleware('auth:teacher')->controller(TrxAssessmentController::class)->group(function () {
    Route::prefix('/assessment/{format}')->group(function () {
        Route::get('/create', 'create')->name('assessments.create');
        Route::post('/store', 'store')->name('assessments.store');
        Route::get('/edit/{assessment}', 'edit')->name('assessments.edit');
        Route::put('/update/{assessment}', 'update')->name('assessments.update');
        Route::delete('/destroy/{assessment}', 'destroy')->name('assessments.destroy');
    });
    Route::get('/class', 'index_class')->name('assessments.class.index');
    Route::get('/class/{format}', 'show_class')->name('assessments.class.show');
});

Route::middleware('auth:student')->get('/student-assessment', [TrxAssessmentController::class, 'student']);

Route::post('/login', LoginController::class)->name('login');
Route::get('/logout', LogoutController::class)->name('logout');