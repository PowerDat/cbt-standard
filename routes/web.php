<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartIndexController;
use App\Http\Controllers\PartTargetController;
use App\Http\Controllers\PartTargetSubController;

Route::get('/', function () {
    return view('dashboard');
});
// Auth::routes();

// Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //เกณฑ์มาตรฐาน
    Route::get('evaluate', [EvaluateController::class, 'index'])->name('evaluate.index');
    Route::get('evaluate/target/{part_id?}', [EvaluateController::class, 'target'])->name('evaluate.target');
    Route::get('evaluate/form/{part_target_id?}', [EvaluateController::class, 'form'])->name('evaluate.form');
    Route::get('evaluate/show/{part_target_id?}', [EvaluateController::class, 'show'])->name('evaluate.show');
    Route::post('evaluate/store', [EvaluateController::class, 'store'])->name('evaluate.store');
    Route::post('evaluate/save-draft', [EvaluateController::class, 'saveDraft'])->name('evaluate.save-draft');

    //ข้อมูลเกณฑ์มาตรฐาน
    Route::resource('part', PartController::class);
    Route::resource('part-target', PartTargetController::class);
    Route::resource('part-target-sub', PartTargetSubController::class);
    Route::resource('part-index', PartIndexController::class);
    Route::get('part-index/createById/{id?}', [PartIndexController::class, 'createById'])->name('part-index.createById');
    //report
    Route::get('report/part', [ReportController::class, 'part'])->name('report.part');
// });





