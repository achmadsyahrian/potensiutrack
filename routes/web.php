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
    Route::resource('/web-applications', \App\Http\Controllers\Administrator\WebAppController::class)->names('webapps');

    // Akun
    Route::resource('/accounts/lecturers', \App\Http\Controllers\Administrator\LecturerController::class)->names('lecturers');
    Route::resource('/accounts/administrator', \App\Http\Controllers\Administrator\AdministratorController::class)->names('accounts.administrator');
    Route::resource('/accounts/employee', \App\Http\Controllers\Administrator\EmployeeController::class)->names('accounts.employee');
    Route::resource('/accounts/technician', \App\Http\Controllers\Administrator\TechnicianController::class)->names('accounts.technician');
    Route::resource('/accounts/lab-assistant', \App\Http\Controllers\Administrator\LabAssistantController::class)->names('accounts.labassistant');
    Route::resource('/accounts/section-head', \App\Http\Controllers\Administrator\SectionHeadController::class)->names('accounts.sectionhead');
    Route::resource('/accounts/puskom', \App\Http\Controllers\Administrator\PuskomController::class)->names('accounts.puskom');
});

// Kabag
Route::prefix('sectionhead')->middleware('checkRole:2')->group(function () {
    Route::get('/repair-requests', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'index'])->name('sectionhead.repairrequests.index');
    Route::get('/repair-requests/{id}', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'show'])->name('sectionhead.repairrequests.show');
    Route::patch('/repair-requests/{id}/verify', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'verify'])->name('sectionhead.repairrequests.verify');
    Route::patch('/repair-requests/{id}/reject', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'reject'])->name('sectionhead.repairrequests.reject');

    // PC Daily Check
    Route::get('/employee-daily-check', [\App\Http\Controllers\SectionHead\EmployeePcDailyCheckController::class, 'index'])->name('sectionhead.employeepcdailychecks.index');    
    Route::get('/employee-daily-check/{year}/{month}/{division}', [\App\Http\Controllers\SectionHead\EmployeePcDailyCheckController::class, 'showByMonthAndDivision'])
            ->name('sectionhead.employeepcdailychecks.showByMonthAndDivision');
    Route::get('/employee-daily-check/{id}', [\App\Http\Controllers\SectionHead\EmployeePcDailyCheckController::class, 'show'])->name('sectionhead.employeepcdailychecks.show');    
    Route::post('/employee-daily-check/{year}/{month}/{division}/verify', [\App\Http\Controllers\SectionHead\EmployeePcDailyCheckController::class, 'verify'])->name('sectionhead.employeepcdailychecks.verify');    

    // Lab Usage
    Route::get('/lab-usages', [\App\Http\Controllers\SectionHead\LabUsageMonthlyReportController::class, 'index'])->name('sectionhead.labusagesreport.index');    
    Route::get('/lab-usages/{year}/{month}/{lab}', [\App\Http\Controllers\SectionHead\LabUsageMonthlyReportController::class, 'showByIndex'])
            ->name('sectionhead.labusagesreport.showByIndex');
    Route::get('/lab-usages/{id}', [\App\Http\Controllers\SectionHead\LabUsageMonthlyReportController::class, 'show'])->name('sectionhead.labusagesreport.show');    
    Route::post('/lab-usages/{year}/{month}/{lab}/verify', [\App\Http\Controllers\SectionHead\LabUsageMonthlyReportController::class, 'verify'])->name('sectionhead.labusagesreport.verify');

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

    Route::get('/employee-daily-check', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'index'])->name('technician.employeepcdailychecksreport.index');    
    Route::get('/employee-daily-check/{year}/{month}/{division}', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'showByMonthAndDivision'])
            ->name('technician.employeepcdailychecksreport.showByMonthAndDivision');
    Route::get('/employee-daily-check/{id}', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'show'])->name('technician.employeepcdailychecksreport.show');    
    Route::post('/employee-daily-check/{year}/{month}/{division}/verify', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'verify'])->name('technician.employeepcdailychecksreport.verify');
    
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
    Route::get('/network-troubleshooting', [\App\Http\Controllers\Employee\NetworkTroubleshootingController::class, 'index'])->name('employee.networktroubleshooting.index');
    Route::get('/network-troubleshooting/{id}', [\App\Http\Controllers\Employee\NetworkTroubleshootingController::class, 'show'])->name('employee.networktroubleshooting.show');
    Route::patch('/network-troubleshooting/{id}/verify', [\App\Http\Controllers\Employee\NetworkTroubleshootingController::class, 'verify'])->name('employee.networktroubleshooting.verify');

    // Web Development
    Route::get('/web-development', [\App\Http\Controllers\Employee\WebDevelopmentController::class, 'index'])->name('employee.webdevelopment.index');
    Route::get('/web-development/{id}', [\App\Http\Controllers\Employee\WebDevelopmentController::class, 'show'])->name('employee.webdevelopment.show');
    Route::patch('/web-development/{id}/verify', [\App\Http\Controllers\Employee\WebDevelopmentController::class, 'verify'])->name('employee.webdevelopment.verify');

    // Web Maintenance
    Route::get('/web-maintenance', [\App\Http\Controllers\Employee\WebMaintenanceController::class, 'index'])->name('employee.webmaintenance.index');
    Route::get('/web-maintenance/{id}', [\App\Http\Controllers\Employee\WebMaintenanceController::class, 'show'])->name('employee.webmaintenance.show');
    Route::patch('/web-maintenance/{id}/verify', [\App\Http\Controllers\Employee\WebMaintenanceController::class, 'verify'])->name('employee.webmaintenance.verify');
});

// Puskom
Route::prefix('puskom')->middleware('checkRole:7')->group(function () {
    // Network Development
    Route::resource('/network-development', \App\Http\Controllers\Puskom\NetworkConnectionDevelopmentController::class)->names('puskom.networkdev');
    Route::patch('/network-development/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\NetworkConnectionDevelopmentController::class, 'markAsComplete'])->name('puskom.networkdev.markAsComplete');

    //Network Troubleshooting
    Route::resource('/network-troubleshooting', \App\Http\Controllers\Puskom\NetworkTroubleshootingController::class)->names('puskom.networktroubleshooting');
    Route::patch('/network-troubleshooting/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\NetworkTroubleshootingController::class, 'markAsComplete'])->name('puskom.networktroubleshooting.markAsComplete');

    //Web Development
    Route::resource('/web-development', \App\Http\Controllers\Puskom\WebDevelopmentRequestController::class)->names('puskom.webdevelopment');
    Route::patch('/web-development/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\WebDevelopmentRequestController::class, 'markAsComplete'])->name('puskom.webdevelopment.markAsComplete');

    //Web Maintenance
    Route::resource('/web-maintenance', \App\Http\Controllers\Puskom\WebMaintenanceController::class)->names('puskom.webmaintenance');
    Route::patch('/web-maintenance/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\WebMaintenanceController::class, 'markAsComplete'])->name('puskom.webmaintenance.markAsComplete');

    //Wifi Check
    Route::resource('/wifi-checking', \App\Http\Controllers\Puskom\WifiCheckingController::class)->names('puskom.wifichecking');
});

// Wakil Rektor
Route::prefix('vicerector')->middleware('checkRole:8')->group(function () {
    Route::get('/repair-requests', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'index'])->name('vicerector.repairrequests.index');
    Route::get('/repair-requests/{id}', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'show'])->name('vicerector.repairrequests.show');
    Route::patch('/repair-requests/{id}/verify', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'verify'])->name('vicerector.repairrequests.verify');
    Route::patch('/repair-requests/{id}/reject', [\App\Http\Controllers\SectionHead\RepairRequestController::class, 'reject'])->name('vicerector.repairrequests.reject');

    // PC Daily Check
    Route::get('/employee-daily-check', [\App\Http\Controllers\ViceRector\EmployeePcDailyCheckController::class, 'index'])->name('vicerector.employeepcdailychecks.index');    
    Route::get('/employee-daily-check/{year}/{month}/{division}', [\App\Http\Controllers\ViceRector\EmployeePcDailyCheckController::class, 'showByMonthAndDivision'])
            ->name('vicerector.employeepcdailychecks.showByMonthAndDivision');
    Route::get('/employee-daily-check/{id}', [\App\Http\Controllers\ViceRector\EmployeePcDailyCheckController::class, 'show'])->name('vicerector.employeepcdailychecks.show');    
    Route::post('/employee-daily-check/{year}/{month}/{division}/verify', [\App\Http\Controllers\ViceRector\EmployeePcDailyCheckController::class, 'verify'])->name('vicerector.employeepcdailychecks.verify');    

    // Lab Usage
    Route::get('/lab-usages', [\App\Http\Controllers\ViceRector\LabUsageMonthlyReportController::class, 'index'])->name('vicerector.labusagesreport.index');    
    Route::get('/lab-usages/{year}/{month}/{lab}', [\App\Http\Controllers\ViceRector\LabUsageMonthlyReportController::class, 'showByIndex'])
            ->name('vicerector.labusagesreport.showByIndex');
    Route::get('/lab-usages/{id}', [\App\Http\Controllers\ViceRector\LabUsageMonthlyReportController::class, 'show'])->name('vicerector.labusagesreport.show');    
    Route::post('/lab-usages/{year}/{month}/{lab}/verify', [\App\Http\Controllers\ViceRector\LabUsageMonthlyReportController::class, 'verify'])->name('vicerector.labusagesreport.verify');

});

// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
});
