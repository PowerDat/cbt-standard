<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Evaluate\CommunityController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartTargetController;
use App\Http\Controllers\PartTargetSubController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//เกณฑ์มาตรฐาน
Route::get('evaluate', [EvaluateController::class, 'index'])->name('evaluate.index');
Route::get('evaluate/community', [CommunityController::class, 'index'])->name('evaluate.community.index');
Route::get('evaluate/community/form-goal-first', [CommunityController::class, 'formGoalFirst'])->name('evaluate.community.form-goal-first');
//ข้อมูลเกณฑ์มาตรฐาน
Route::resource('part', PartController::class);
Route::resource('part-target', PartTargetController::class);
Route::resource('part-target-sub', PartTargetSubController::class);
