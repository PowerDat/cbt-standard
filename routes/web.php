<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\PartTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartIndexController;
use App\Http\Controllers\PartDetailController;
use App\Http\Controllers\PartTargetController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PartTargetSubController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/post-login', [AuthController::class, 'postLogin'])->name('auth.post-login'); 
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

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
    Route::get('evaluate/getPartType/{part_type_id?}', [EvaluateController::class, 'getPartType'])->name('evaluate.getPartType');
    
    //สร้างจากหน้า part target
    Route::resource('part-target', PartTargetController::class);
    Route::get('part-target/createByPartId/{id?}', [PartTargetController::class, 'createByPartId'])->name('part-target.createByPartId');
    Route::post('part-target/delete', [PartTargetController::class, 'delete'])->name('part-target.delete');
    Route::resource('part-target-sub', PartTargetSubController::class);
    Route::resource('part-index', PartIndexController::class);
    Route::get('part-index/create-by-id/{id?}', [PartIndexController::class, 'createById'])->name('part-index.create-by-id');

    //รายละเอียดของแต่ละด้าน
    Route::get('part-detail/createByTargetId/{id?}', [PartDetailController::class, 'createByTargetId'])->name('part-detail.createByTargetId');
    Route::post('part-detail/fetchPartTargetById', [PartDetailController::class, 'fetchPartTargetById'])->name('part-detail.fetchPartTargetById');
    Route::resource('part-detail', PartDetailController::class);
    Route::post('part-detail/saveTargetSub', [PartDetailController::class, 'saveTargetSub'])->name('part-detail.saveTargetSub');
    Route::post('part-detail/delete', [PartDetailController::class, 'delete'])->name('part-detail.delete');
    
    //report
    Route::get('report/part', [ReportController::class, 'part'])->name('report.part');
    Route::get('report/part-first', [ReportController::class, 'partFirst'])->name('report.part-first');
    Route::get('report/part-second', [ReportController::class, 'partSecond'])->name('report.part-second');
    Route::get('report/part-third', [ReportController::class, 'partThird'])->name('report.part-third');
    Route::get('report/part-fourth', [ReportController::class, 'partFourth'])->name('report.part-fourth');
    Route::get('report/part-fifth', [ReportController::class, 'partFifth'])->name('report.part-fifth');

    //ประเภทเกณฑ์มาตรฐาน
    Route::resource('part-type', PartTypeController::class);
    Route::post('part-type/delete', [PartTypeController::class, 'delete'])->name('part-type.delete');
    //ข้อมูลเกณฑ์มาตรฐาน
    Route::get('part/createByPartTypeId/{id?}', [PartController::class, 'createByPartTypeId'])->name('part.createByPartTypeId');
    Route::post('part/delete', [PartController::class, 'delete'])->name('part.delete');
    Route::resource('part', PartController::class);

    // ตั้งค่าระบบ
    Route::resource('role', RoleController::class);
    Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');

    Route::post('role/{role}/assign-permission', [RoleController::class, 'assignPermission'])->name('role.assign-permission');

    Route::resource('permission', PermissionController::class);
    Route::post('permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');

    Route::resource('user', UserController::class);
    Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/change-password/{id?}', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('user/save-change-password', [UserController::class, 'saveChangePassword'])->name('user.save-change-password');

    Route::get('user-profile/createById/{id?}', [UserProfileController::class, 'createById'])->name('user-profile.createById');
    Route::resource('user-profile', UserProfileController::class);
    Route::post('user-profile/delete', [UserProfileController::class, 'delete'])->name('user-profile.delete');

    Route::resource('menu', MenuController::class);
    Route::get('sub-menu/createByMenuId/{id?}', [SubMenuController::class, 'createByMenuId'])->name('sub-menu.createByMenuId');
    Route::resource('sub-menu', SubMenuController::class);

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

});

// Route::middleware(['auth', 'role:administrator'])->group(function(){
//     //ประเภทเกณฑ์มาตรฐาน
//     Route::resource('part-type', PartTypeController::class);
//     Route::post('part-type/delete', [PartTypeController::class, 'delete'])->name('part-type.delete');
//     //ข้อมูลเกณฑ์มาตรฐาน
//     Route::get('part/createByPartTypeId/{id?}', [PartController::class, 'createByPartTypeId'])->name('part.createByPartTypeId');
//     Route::post('part/delete', [PartController::class, 'delete'])->name('part.delete');
//     Route::resource('part', PartController::class);

//     // ตั้งค่าระบบ
//     Route::resource('role', RoleController::class);
//     Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');

//     Route::post('role/{role}/assign-permission', [RoleController::class, 'assignPermission'])->name('role.assign-permission');

//     Route::resource('permission', PermissionController::class);
//     Route::post('permission/delete', [PermissionController::class, 'delete'])->name('permission.delete');

//     Route::resource('user', UserController::class);
//     Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');
//     Route::get('user/change-password/{id?}', [UserController::class, 'changePassword'])->name('user.change-password');
//     Route::post('user/save-change-password', [UserController::class, 'saveChangePassword'])->name('user.save-change-password');

//     Route::get('user-profile/createById/{id?}', [UserProfileController::class, 'createById'])->name('user-profile.createById');
//     Route::resource('user-profile', UserProfileController::class);
//     Route::post('user-profile/delete', [UserProfileController::class, 'delete'])->name('user-profile.delete');

//     Route::resource('menu', MenuController::class);
//     Route::get('sub-menu/createByMenuId/{id?}', [SubMenuController::class, 'createByMenuId'])->name('sub-menu.createByMenuId');
//     Route::resource('sub-menu', SubMenuController::class);

//     Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
// });