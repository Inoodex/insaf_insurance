<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', [\App\Http\Controllers\Student\Auth\LoginController::class, 'showLoginForm']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('tyro-dashboard.index');

Route::prefix('dashboard/settings')->name('admin.settings.')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/update', [SettingController::class, 'update'])->name('update');
});

// Role Management Overrides
use App\Http\Controllers\Admin\RoleController as LocalRoleController;
Route::prefix('dashboard/roles')->name('tyro-dashboard.roles.')->group(function () {
    Route::get('/', [LocalRoleController::class, 'index'])->name('index');
    Route::get('/create', [LocalRoleController::class, 'create'])->name('create');
    Route::post('/', [LocalRoleController::class, 'store'])->name('store');
    Route::get('{id}/edit', [LocalRoleController::class, 'edit'])->name('edit');
    Route::put('{id}', [LocalRoleController::class, 'update'])->name('update');
    Route::post('{id}/toggle', [LocalRoleController::class, 'toggleStatus'])->name('toggle');
    Route::delete('{id}', [LocalRoleController::class, 'destroy'])->name('destroy');
});

// Insurance Management routes
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InsurancePlanController;
use App\Http\Controllers\Admin\InsuranceApplicationController;

// Student Auth & Dashboard
use App\Http\Controllers\Student\Auth\LoginController as StudentLoginController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\PolicyController as StudentPolicyController;
use App\Http\Controllers\Student\ClaimController as StudentClaimController;

// Student Routes

    Route::get('login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
    Route::post('login', [StudentLoginController::class, 'login']);
    Route::post('student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

    Route::get('forgot-password', [\App\Http\Controllers\Student\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('student.password.request');
    Route::post('forgot-password', [\App\Http\Controllers\Student\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('student.password.email');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Student\Auth\ForgotPasswordController::class, 'showResetForm'])->name('student.password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Student\Auth\ForgotPasswordController::class, 'reset'])->name('student.password.update');

// Admin password reset routes (for admin login page)
use HasinHayder\TyroLogin\Http\Controllers\PasswordResetController;
Route::prefix('admin')->name('tyro-login.')->group(function () {
    Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::get('download-policy/{application}', [StudentPolicyController::class, 'download'])->name('download-policy');

Route::prefix('student')->group(function () {

    Route::middleware(['auth:student'])->group(function () {
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
        Route::get('profile', [StudentProfileController::class, 'index'])->name('student.profile');
        Route::post('profile/address', [StudentProfileController::class, 'updateAddress'])->name('student.profile.address');
        Route::post('profile/correspondence', [StudentProfileController::class, 'updateCorrespondence'])->name('student.profile.correspondence');
        Route::post('profile/password', [StudentProfileController::class, 'updatePassword'])->name('student.profile.password');
        
        Route::get('policies/{application}', [StudentPolicyController::class, 'show'])->name('student.policies.show');
        Route::get('policies/{application}/finance', [StudentPolicyController::class, 'finance'])->name('student.policies.finance');

        // Claims
        Route::get('claims', [StudentClaimController::class, 'index'])->name('student.claims.index');
        Route::get('claims/create', [StudentClaimController::class, 'create'])->name('student.claims.create');
        Route::post('claims/create', [StudentClaimController::class, 'create'])->name('student.claims.create.post');
        Route::post('claims', [StudentClaimController::class, 'store'])->name('student.claims.store');
        Route::get('claims/{claim}', [StudentClaimController::class, 'show'])->name('student.claims.show');
    });
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    // Students
    Route::post('students/{student}/send-credentials', [StudentController::class, 'sendCredentials'])->name('admin.students.send-credentials');
    Route::resource('students', StudentController::class)->names('admin.students');
    
    // Insurance Plans
    Route::resource('plans', InsurancePlanController::class)->names('admin.plans');
    
    // Insurance Applications
    Route::resource('applications', InsuranceApplicationController::class)->names('admin.applications');
    Route::post('applications/{application}/issue', [InsuranceApplicationController::class, 'issue'])->name('admin.applications.issue');
    Route::post('applications/{application}/send-receipt', [InsuranceApplicationController::class, 'sendReceipt'])->name('admin.applications.send-receipt');
    Route::post('applications/{application}/send-policy', [InsuranceApplicationController::class, 'sendPolicy'])->name('admin.applications.send-policy');
    Route::post('applications/{application}/mark-paid', [InsuranceApplicationController::class, 'markAsPaid'])->name('admin.applications.mark-paid');
    Route::get('applications/{application}/pdf-preview', [InsuranceApplicationController::class, 'previewPdf'])->name('admin.applications.pdf-preview');

    // Claims Management
    Route::get('claims', [App\Http\Controllers\Admin\ClaimController::class, 'index'])->name('admin.claims.index');
    Route::get('claims/{claim}', [App\Http\Controllers\Admin\ClaimController::class, 'show'])->name('admin.claims.show');
    Route::post('claims/{claim}/process', [App\Http\Controllers\Admin\ClaimController::class, 'process'])->name('admin.claims.process');
    Route::delete('claims/{claim}', [App\Http\Controllers\Admin\ClaimController::class, 'destroy'])->name('admin.claims.destroy');
});