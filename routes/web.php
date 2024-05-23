<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartIndexController;
use App\Http\Controllers\PartDetailController;
use App\Http\Controllers\PartTargetController;
use App\Http\Controllers\PartTargetSubController;

Route::get('/', function () {
    return redirect()->route('login');
});
// Route::get('/', function () {
//     return view('dashboard');
// });
Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //เกณฑ์มาตรฐาน
    Route::get('evaluate', [EvaluateController::class, 'index'])->name('evaluate.index');
    Route::get('evaluate/target/{part_id?}', [EvaluateController::class, 'target'])->name('evaluate.target');
    Route::get('evaluate/form/{part_target_id?}', [EvaluateController::class, 'form'])->name('evaluate.form');
    Route::get('evaluate/show/{part_target_id?}', [EvaluateController::class, 'show'])->name('evaluate.show');
    Route::post('evaluate/store', [EvaluateController::class, 'store'])->name('evaluate.store');
    Route::post('evaluate/save-draft', [EvaluateController::class, 'saveDraft'])->name('evaluate.save-draft');

    //ข้อมูลเกณฑ์มาตรฐาน
    Route::post('part/delete', [PartController::class, 'delete'])->name('part.delete');
    Route::resource('part', PartController::class);
    
    //สร้างจากหน้า part target
    // Route::get('part-target/create-by-id/{part_target_id?}', [PartTargetController::class, 'createById'])->name('part-target.create-by-id');
    // Route::post('part-target/updated/{id?}', [PartTargetController::class, 'updated'])->name('part-target.updated');
    Route::resource('part-target', PartTargetController::class);
    Route::get('part-target/createByPartId/{id?}', [PartTargetController::class, 'createByPartId'])->name('part-target.createByPartId');
    Route::post('part-target/delete', [PartTargetController::class, 'delete'])->name('part-target.delete');
    // Route::get('part-target-sub/create-by-id/{id?}', [PartTargetSubController::class, 'createById'])->name('part-target-sub.create-by-id');
    Route::resource('part-target-sub', PartTargetSubController::class);
    Route::resource('part-index', PartIndexController::class);
    Route::get('part-index/create-by-id/{id?}', [PartIndexController::class, 'createById'])->name('part-index.create-by-id');
    //รายละเอียดของแต่ละด้าน
    Route::get('part-detail/createByTargetId/{id?}', [PartDetailController::class, 'createByTargetId'])->name('part-detail.createByTargetId');
    Route::post('part-detail/fetchPartTargetById', [PartDetailController::class, 'fetchPartTargetById'])->name('part-detail.fetchPartTargetById');
    Route::resource('part-detail', PartDetailController::class);
    Route::post('part-detail/saveTargetSub', [PartDetailController::class, 'saveTargetSub'])->name('part-detail.saveTargetSub');
    
    //report
    Route::get('report/part', [ReportController::class, 'part'])->name('report.part');
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
