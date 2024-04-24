<?php

use Illuminate\Support\Facades\Route;

// Authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    // Profile
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.get');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'deletePhoto'])->name('profilephoto.delete');
    Route::get('/password', [\App\Http\Controllers\ProfileController::class, 'editPassword'])->name('profile.editpassword');
    Route::patch('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.updatepassword');

});

// Administrator
Route::group(['middleware' => 'checkRole:1'], function () {
    Route::resource('/users', \App\Http\Controllers\Administrator\UserController::class)->names('users');
    Route::resource('/computers', \App\Http\Controllers\Administrator\ComputerController::class)->names('computers');
    Route::resource('/labs', \App\Http\Controllers\Administrator\LabController::class)->names('labs');
    Route::resource('/roles', \App\Http\Controllers\Administrator\RoleController::class)->names('roles');
    Route::resource('/divisions', \App\Http\Controllers\Administrator\DivisionController::class)->names('divisions');
    Route::resource('/item-inventories', \App\Http\Controllers\Administrator\ItemInventoryController::class)->names('iteminventories');

    // Akun
    Route::resource('/accounts/lecturers', \App\Http\Controllers\Administrator\LecturerController::class)->names('lecturers');
    Route::resource('/accounts/administrator', \App\Http\Controllers\Administrator\AdministratorController::class)->names('accounts.administrator');
    Route::resource('/accounts/employee', \App\Http\Controllers\Administrator\EmployeeController::class)->names('accounts.employee');
    Route::resource('/accounts/technician', \App\Http\Controllers\Administrator\TechnicianController::class)->names('accounts.technician');
    Route::resource('/accounts/lab-assistant', \App\Http\Controllers\Administrator\LabAssistantController::class)->names('accounts.labassistant');
    Route::resource('/accounts/section-head', \App\Http\Controllers\Administrator\SectionHeadController::class)->names('accounts.sectionhead');
});

// Kabag
Route::prefix('sectionhead')->middleware('checkRole:2')->group(function () {
    Route::get('/repair-requests', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'index'])->name('sectionhead.repairrequests.index');
    Route::get('/repair-requests/{id}', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'show'])->name('sectionhead.repairrequests.show');
    Route::patch('/repair-requests/{id}/verify', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'verify'])->name('sectionhead.repairrequests.verify');
    Route::patch('/repair-requests/{id}/reject', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'reject'])->name('sectionhead.repairrequests.reject');
});

// Asisten Lab
Route::prefix('labassistant')->middleware('checkRole:3')->group(function () {
    // Laporan
    
    // Lab
    Route::resource('/lab-daily-checks', \App\Http\Controllers\LabAssistant\LabDailyCheckController::class)->names('labassistant.labdailychecks');
    Route::get('/pilih-lab/{id}', [\App\Http\Controllers\LabAssistant\LabDailyCheckController::class, 'pilihLab'])->name('pilih-lab');
    Route::resource('/lab-request', \App\Http\Controllers\LabAssistant\LabRequestController::class)->names('labassistant.labrequests');
    Route::resource('/lab-usages', \App\Http\Controllers\LabAssistant\LabUsageController::class)->names('labassistant.labusages');
});

// Teknisi
Route::prefix('technician')->middleware('checkRole:4')->group(function () {
    Route::resource('/repair-requests', \App\Http\Controllers\Technician\RepairRequestController::class)->names('technician.repairrequests');
    Route::resource('/employee-pc-daily-checks', \App\Http\Controllers\Technician\EmployeePcDailyCheckController::class)->names('technician.employeepcdailychecks');
});

// Pegawai
Route::prefix('employee')->middleware('checkRole:5')->group(function () {
    // Repair Request
    Route::get('/repair-requests', [\App\Http\Controllers\Employee\RepairRequestController::class, 'index'])->name('employee.repairrequests.index');
    Route::get('/repair-requests/{id}', [\App\Http\Controllers\Employee\RepairRequestController::class, 'show'])->name('employee.repairrequests.show');
    Route::patch('/repair-requests/{id}/verify', [\App\Http\Controllers\Employee\RepairRequestController::class, 'verify'])->name('employee.repairrequests.verify');

    // Network Development
    Route::get('/network-development', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'index'])->name('employee.networkdev.index');
    Route::get('/network-development/{id}', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'show'])->name('employee.networkdev.show');
    Route::patch('/network-development/{id}/verify', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'verify'])->name('employee.networkdev.verify');

    // Network Troubleshooting
    Route::get('/network-troubleshooting', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'index'])->name('employee.networkdev.index');
    Route::get('/network-troubleshooting/{id}', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'show'])->name('employee.networkdev.show');
    Route::patch('/network-troubleshooting/{id}/verify', [\App\Http\Controllers\Employee\NetworkConnectionDevelopmentController::class, 'verify'])->name('employee.networkdev.verify');
});

// Puskom
Route::prefix('puskom')->middleware('checkRole:7')->group(function () {
    // Network Development
    Route::resource('/network-development', \App\Http\Controllers\Puskom\NetworkConnectionDevelopmentController::class)->names('puskom.networkdev');
    Route::patch('/network-development/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\NetworkConnectionDevelopmentController::class, 'markAsComplete'])->name('puskom.networkdev.markAsComplete');

    //Network Troubleshooting
    Route::resource('/network-troubleshooting', \App\Http\Controllers\Puskom\NetworkTroubleshootingController::class)->names('puskom.networktroubleshooting');
    Route::patch('/network-troubleshooting/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\NetworkTroubleshootingController::class, 'markAsComplete'])->name('puskom.networktroubleshooting.markAsComplete');
});

// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
});
