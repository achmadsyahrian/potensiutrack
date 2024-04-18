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

    // Dosen
    Route::resource('/lecturers', \App\Http\Controllers\Administrator\LecturerController::class)->names('lecturers');
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
    Route::resource('/lab-daily-checks', \App\Http\Controllers\LabAssistant\LabDailyCheckController::class)->names('labassistant.labdailychecks');
    Route::get('/pilih-lab/{id}', [\App\Http\Controllers\LabAssistant\LabDailyCheckController::class, 'pilihLab'])->name('pilih-lab');

    // Lab
    Route::resource('/lab-request', \App\Http\Controllers\LabAssistant\LabRequestController::class)->names('labassistant.labrequest');
});

// Teknisi
Route::prefix('technician')->middleware('checkRole:4')->group(function () {
    Route::resource('/repair-requests', \App\Http\Controllers\Technician\RepairRequestController::class)->names('technician.repairrequests');
});

// Karyawan
Route::prefix('employee')->middleware('checkRole:5')->group(function () {
    Route::get('/repair-requests', [\App\Http\Controllers\Employee\RepairRequestController::class, 'index'])->name('employee.repairrequests.index');
    Route::get('/repair-requests/{id}', [\App\Http\Controllers\Employee\RepairRequestController::class, 'show'])->name('employee.repairrequests.show');
    Route::patch('/repair-requests/{id}/verify', [\App\Http\Controllers\Employee\RepairRequestController::class, 'verify'])->name('employee.repairrequests.verify');
});


// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
});
