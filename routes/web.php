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
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Report\CommitteeReportController;
use App\Http\Controllers\Report\CommunityReportController;

Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/post-login', [AuthController::class, 'postLogin'])->name('auth.post-login'); 
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        Route::get('/community', [DashboardController::class, 'community'])->name('community');
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::get('/researcher', [DashboardController::class, 'researcher'])->name('researcher');
        Route::get('/committee', [DashboardController::class, 'committee'])->name('committee');
    });

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard/community', [DashboardController::class, 'community'])->name('dashboard.community');
    // Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    // Route::get('/dashboard/researcher', [DashboardController::class, 'researcher'])->name('dashboard.researcher');
    // Route::get('/dashboard/committee', [DashboardController::class, 'committee'])->name('dashboard.committee');
    
    //เกณฑ์มาตรฐาน
    Route::get('evaluate', [EvaluateController::class, 'index'])->name('evaluate.index');
    Route::get('evaluate/target/{part_id?}', [EvaluateController::class, 'target'])->name('evaluate.target');
    Route::get('evaluate/form/{part_target_id?}', [EvaluateController::class, 'form'])->name('evaluate.form');
    Route::get('evaluate/edit/{part_target_id?}', [EvaluateController::class, 'edit'])->name('evaluate.edit');
    Route::get('evaluate/show/{part_target_id?}', [EvaluateController::class, 'show'])->name('evaluate.show');
    Route::post('evaluate/store', [EvaluateController::class, 'store'])->name('evaluate.store');
    Route::post('evaluate/save-draft', [EvaluateController::class, 'saveDraft'])->name('evaluate.save-draft');
    Route::get('evaluate/getPartType/{part_type_id?}', [EvaluateController::class, 'getPartType'])->name('evaluate.getPartType');
    Route::post('evaluate/save-community', [EvaluateController::class, 'saveCommunity'])->name('evaluate.save-community');
    
    //report
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::get('report/self-assessment', [ReportController::class, 'selfAssessment'])->name('report.self-assessment');
    
    Route::get('report/evaluation-committee', [ReportController::class, 'evaluationCommittee'])->name('report.evaluation-committee');
    Route::get('report/part/{id?}', [ReportController::class, 'part'])->name('report.part');
    Route::get('report/part-first', [ReportController::class, 'partFirst'])->name('report.part-first');
    Route::get('report/part-second', [ReportController::class, 'partSecond'])->name('report.part-second');
    Route::get('report/part-third', [ReportController::class, 'partThird'])->name('report.part-third');
    Route::get('report/part-fourth', [ReportController::class, 'partFourth'])->name('report.part-fourth');
    Route::get('report/part-fifth', [ReportController::class, 'partFifth'])->name('report.part-fifth');
    
    //report community
    Route::get('report/community/index', [CommunityReportController::class, 'index'])->name('report.community.index');
    Route::get('report/community/committee', [CommunityReportController::class, 'committee'])->name('report.community.committee');
    Route::post('report/community/evaluation-committee', [CommunityReportController::class, 'evaluationCommittee'])->name('report.community.evaluation-committee');
    Route::get('report/community/summary', [CommunityReportController::class, 'summary'])->name('report.community.summary');
    Route::get('report/community/pdf', [CommunityReportController::class, 'pdf'])->name('report.community.pdf');
    //report committee
    Route::get('report/committee/index', [CommitteeReportController::class, 'index'])->name('report.committee.index');
    Route::post('report/committee/get-result', [CommitteeReportController::class, 'getResult'])->name('report.committee.get-result');
    Route::get('report/committee/summary', [CommitteeReportController::class, 'summary'])->name('report.committee.summary');

    //จัดการผู้ใช้งาน
    Route::resource('user', UserController::class);
    Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/change-password/{id?}', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('user/save-change-password', [UserController::class, 'saveChangePassword'])->name('user.save-change-password');

    Route::get('user-profile/createById/{id?}', [UserProfileController::class, 'createById'])->name('user-profile.createById');
    Route::resource('user-profile', UserProfileController::class);
    Route::post('user-profile/delete', [UserProfileController::class, 'delete'])->name('user-profile.delete');

    Route::resource('committee', CommitteeController::class);
    Route::post('committee/delete', [CommitteeController::class, 'delete'])->name('committee.delete');
    Route::get('committee/change-password/{id?}', [CommitteeController::class, 'changePassword'])->name('committee.change-password');
    Route::post('committee/save-change-password', [CommitteeController::class, 'saveChangePassword'])->name('committee.save-change-password');
});

Route::middleware(['auth', 'role:administrator'])->group(function(){
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

    //จัดการผู้ใช้งาน
    // Route::resource('user', UserController::class);
    // Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');
    // Route::get('user/change-password/{id?}', [UserController::class, 'changePassword'])->name('user.change-password');
    // Route::post('user/save-change-password', [UserController::class, 'saveChangePassword'])->name('user.save-change-password');

    // Route::get('user-profile/createById/{id?}', [UserProfileController::class, 'createById'])->name('user-profile.createById');
    // Route::resource('user-profile', UserProfileController::class);
    // Route::post('user-profile/delete', [UserProfileController::class, 'delete'])->name('user-profile.delete');

    Route::resource('menu', MenuController::class);
    Route::get('sub-menu/createByMenuId/{id?}', [SubMenuController::class, 'createByMenuId'])->name('sub-menu.createByMenuId');
    Route::resource('sub-menu', SubMenuController::class);

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});

// Route::middleware(['auth', 'role:researcher', 'role:administrator'])->group(function(){
//     //จัดการผู้ใช้งาน
//     Route::resource('user', UserController::class);
//     Route::post('user/delete', [UserController::class, 'delete'])->name('user.delete');
//     Route::get('user/change-password/{id?}', [UserController::class, 'changePassword'])->name('user.change-password');
//     Route::post('user/save-change-password', [UserController::class, 'saveChangePassword'])->name('user.save-change-password');

//     Route::get('user-profile/createById/{id?}', [UserProfileController::class, 'createById'])->name('user-profile.createById');
//     Route::resource('user-profile', UserProfileController::class);
//     Route::post('user-profile/delete', [UserProfileController::class, 'delete'])->name('user-profile.delete');
// });
