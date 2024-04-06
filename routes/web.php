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
});

// Asisten Lab
Route::prefix('labassistant')->middleware('checkRole:3')->group(function () {
    Route::resource('/labdailychecks', \App\Http\Controllers\LabAssistant\LabDailyCheckController::class)->names('labassistant.labdailychecks');
    Route::get('/pilih-lab/{id}', [\App\Http\Controllers\LabAssistant\LabDailyCheckController::class, 'pilihLab'])->name('pilih-lab');
});

// Teknisi
Route::prefix('technician')->middleware('checkRole:4')->group(function () {
    Route::resource('/repair-requests', \App\Http\Controllers\Technician\RepairRequestController::class)->names('technician.repairrequests');
});

// Karyawan
// Route::prefix('employee')->middleware('checkRole:5')->group(function () {
//     Route::resource('/repair-requests', \App\Http\Controllers\Employee\RepairRequestController::class)->names('employee.repairrequests');
// });


// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
});
