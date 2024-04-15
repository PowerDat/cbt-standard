<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Evaluate\CommunityController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartIndexController;
use App\Http\Controllers\PartTargetController;
use App\Http\Controllers\PartTargetSubController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//เกณฑ์มาตรฐาน
Route::get('evaluate', [EvaluateController::class, 'index'])->name('evaluate.index');
Route::get('evaluate/target/{part_id?}', [EvaluateController::class, 'target'])->name('evaluate.target');
Route::get('evaluate/form/{part_target_id?}', [EvaluateController::class, 'form'])->name('evaluate.form');

Route::get('evaluate/community', [CommunityController::class, 'index'])->name('evaluate.community.index');
Route::get('evaluate/community/form-goal-first', [CommunityController::class, 'formGoalFirst'])->name('evaluate.community.form-goal-first');
//ข้อมูลเกณฑ์มาตรฐาน
Route::resource('part', PartController::class);
Route::resource('part-target', PartTargetController::class);
Route::resource('part-target-sub', PartTargetSubController::class);
Route::resource('part-index', PartIndexController::class);
Route::get('part-index/createById/{id?}', [PartIndexController::class, 'createById'])->name('part-index.createById');
//report
Route::get('report/part', [ReportController::class, 'part'])->name('report.part');



