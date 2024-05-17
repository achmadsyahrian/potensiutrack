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

    // Lab Request
    Route::get('/lab-requests', [\App\Http\Controllers\SectionHead\LabRequestMonthlyReportController::class, 'index'])->name('sectionhead.labrequestsreport.index');    
    Route::get('/lab-requests/{year}/{month}/{lab}', [\App\Http\Controllers\SectionHead\LabRequestMonthlyReportController::class, 'showByIndex'])
            ->name('sectionhead.labrequestsreport.showByIndex');
    Route::get('/lab-requests/{id}', [\App\Http\Controllers\SectionHead\LabRequestMonthlyReportController::class, 'show'])->name('sectionhead.labrequestsreport.show');    
    Route::post('/lab-requests/{year}/{month}/{lab}/verify', [\App\Http\Controllers\SectionHead\LabRequestMonthlyReportController::class, 'verify'])->name('sectionhead.labrequestsreport.verify');

    // Lab Daily Check
    Route::get('/lab-daily-check', [\App\Http\Controllers\SectionHead\LabDailyCheckMonthlyReportController::class, 'index'])->name('sectionhead.labdailychecksreport.index');    
    Route::get('/lab-daily-check/{year}/{month}/{lab}', [\App\Http\Controllers\SectionHead\LabDailyCheckMonthlyReportController::class, 'showByIndex'])
            ->name('sectionhead.labdailychecksreport.showByIndex');
    Route::get('/lab-daily-check/{id}', [\App\Http\Controllers\SectionHead\LabDailyCheckMonthlyReportController::class, 'show'])->name('sectionhead.labdailychecksreport.show');    
    Route::post('/lab-daily-check/{year}/{month}/{lab}/verify', [\App\Http\Controllers\SectionHead\LabDailyCheckMonthlyReportController::class, 'verify'])->name('sectionhead.labdailychecksreport.verify');

    // Network Troubleshooting
    Route::get('/network-troubleshooting', [\App\Http\Controllers\SectionHead\NetworkTroubleshootingMonthlyReportController::class, 'index'])->name('sectionhead.networktroubleshootingsreport.index');    
    Route::get('/network-troubleshooting/{year}/{month}', [\App\Http\Controllers\SectionHead\NetworkTroubleshootingMonthlyReportController::class, 'showByIndex'])
            ->name('sectionhead.networktroubleshootingsreport.showByIndex');
    Route::get('/network-troubleshooting/{id}', [\App\Http\Controllers\SectionHead\NetworkTroubleshootingMonthlyReportController::class, 'show'])->name('sectionhead.networktroubleshootingsreport.show');    
    Route::post('/network-troubleshooting/{year}/{month}/verify', [\App\Http\Controllers\SectionHead\NetworkTroubleshootingMonthlyReportController::class, 'verify'])->name('sectionhead.networktroubleshootingsreport.verify');

    // Network Development Report
    Route::get('/report/network-development', [\App\Http\Controllers\SectionHead\NetworkDevelopmentReportController::class, 'index'])->name('sectionhead.networkdevreport.index');    
    Route::get('/report/network-development/{year}/{month}', [\App\Http\Controllers\SectionHead\NetworkDevelopmentReportController::class, 'showByIndex'])
            ->name('sectionhead.networkdevreport.showByIndex');
    Route::get('/report/network-development/{id}', [\App\Http\Controllers\SectionHead\NetworkDevelopmentReportController::class, 'show'])->name('sectionhead.networkdevreport.show');    
    Route::post('/report/network-development/{year}/{month}/verify', [\App\Http\Controllers\SectionHead\NetworkDevelopmentReportController::class, 'verify'])->name('sectionhead.networkdevreport.verify');
    
    // Web Development
    Route::get('/web-development', [\App\Http\Controllers\SectionHead\WebDevelopmentMonthlyReportController::class, 'index'])->name('sectionhead.webdevelopmentsreport.index');    
    Route::get('/web-development/{year}', [\App\Http\Controllers\SectionHead\WebDevelopmentMonthlyReportController::class, 'showByIndex'])
            ->name('sectionhead.webdevelopmentsreport.showByIndex');
    Route::get('/web-development/detail/{id}', [\App\Http\Controllers\SectionHead\WebDevelopmentMonthlyReportController::class, 'show'])->name('sectionhead.webdevelopmentsreport.show');    
    Route::post('/web-development/{year}/verify', [\App\Http\Controllers\SectionHead\WebDevelopmentMonthlyReportController::class, 'verify'])->name('sectionhead.webdevelopmentsreport.verify');

    // Web Maintenance
    Route::get('/web-maintenance', [\App\Http\Controllers\SectionHead\WebMaintenanceReportController::class, 'index'])->name('sectionhead.webmaintenancesreport.index');    
    Route::get('/web-maintenance/{year}', [\App\Http\Controllers\SectionHead\WebMaintenanceReportController::class, 'showByIndex'])
            ->name('sectionhead.webmaintenancesreport.showByIndex');
    Route::get('/web-maintenance/detail/{id}', [\App\Http\Controllers\SectionHead\WebMaintenanceReportController::class, 'show'])->name('sectionhead.webmaintenancesreport.show');    
    Route::post('/web-maintenance/{year}/verify', [\App\Http\Controllers\SectionHead\WebMaintenanceReportController::class, 'verify'])->name('sectionhead.webmaintenancesreport.verify');

    // Wifi Checking
    Route::get('/wifi-checking', [\App\Http\Controllers\SectionHead\WifiCheckingReportController::class, 'index'])->name('sectionhead.wificheckingsreport.index');    
    Route::get('/wifi-checking/{building}', [\App\Http\Controllers\SectionHead\WifiCheckingReportController::class, 'showByIndex'])
            ->name('sectionhead.wificheckingsreport.showByIndex');
    Route::get('/wifi-checking/detail/{id}', [\App\Http\Controllers\SectionHead\WifiCheckingReportController::class, 'show'])->name('sectionhead.wificheckingsreport.show');    
    Route::post('/wifi-checking/{id}/verify', [\App\Http\Controllers\SectionHead\WifiCheckingReportController::class, 'verify'])->name('sectionhead.wificheckingsreport.verify');

    // App Checking
    Route::get('/web-checkings', [\App\Http\Controllers\SectionHead\AppCheckingReportController::class, 'index'])->name('sectionhead.appcheckingsreport.index');    
    Route::get('/web-checkings/detail/{id}', [\App\Http\Controllers\SectionHead\AppCheckingReportController::class, 'show'])->name('sectionhead.appcheckingsreport.show');    
    Route::post('/web-checkings/{id}/verify', [\App\Http\Controllers\SectionHead\AppCheckingReportController::class, 'verify'])->name('sectionhead.appcheckingsreport.verify');

    // Web Assignment Verify
    Route::get('/web-assignment', [\App\Http\Controllers\SectionHead\WebAssignmentController::class, 'index'])->name('sectionhead.webassignment.index');
    Route::post('/web-assignment/{id}/verify', [\App\Http\Controllers\SectionHead\WebAssignmentController::class, 'verify'])->name('sectionhead.webassignment.verify');

    // Network Assignment Verify
    Route::get('/network-assignment', [\App\Http\Controllers\SectionHead\NetworkAssignmentController::class, 'index'])->name('sectionhead.networkassignment.index');
    Route::post('/network-assignment/{id}/verify', [\App\Http\Controllers\SectionHead\NetworkAssignmentController::class, 'verify'])->name('sectionhead.networkassignment.verify');

    // Web Assignment Report
    Route::get('/report/web-assignment', [\App\Http\Controllers\SectionHead\WebAssignmentReportController::class, 'index'])->name('sectionhead.webassignmentreport.index');    
    Route::get('/report/web-assignment/{year}', [\App\Http\Controllers\SectionHead\WebAssignmentReportController::class, 'showByIndex'])
            ->name('sectionhead.webassignmentreport.showByIndex');
    Route::get('/report/web-assignment/detail/{id}', [\App\Http\Controllers\SectionHead\WebAssignmentReportController::class, 'show'])->name('sectionhead.webassignmentreport.show');    
    Route::post('/report/web-assignment/{year}/verify', [\App\Http\Controllers\SectionHead\WebAssignmentReportController::class, 'verify'])->name('sectionhead.webassignmentreport.verify');

    // Network Assignment Report
    Route::get('/report/network-assignment', [\App\Http\Controllers\SectionHead\NetworkAssignmentReportController::class, 'index'])->name('sectionhead.networkassignmentreport.index');    
    Route::get('/report/network-assignment/{year}', [\App\Http\Controllers\SectionHead\NetworkAssignmentReportController::class, 'showByIndex'])
            ->name('sectionhead.networkassignmentreport.showByIndex');
    Route::get('/report/network-assignment/detail/{id}', [\App\Http\Controllers\SectionHead\NetworkAssignmentReportController::class, 'show'])->name('sectionhead.networkassignmentreport.show');    
    Route::post('/report/network-assignment/{year}/verify', [\App\Http\Controllers\SectionHead\NetworkAssignmentReportController::class, 'verify'])->name('sectionhead.networkassignmentreport.verify');

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

    // PC Daily Check
    Route::get('/employee-daily-check', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'index'])->name('technician.employeepcdailychecksreport.index');    
    Route::get('/employee-daily-check/{year}/{month}/{division}', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'showByMonthAndDivision'])
            ->name('technician.employeepcdailychecksreport.showByMonthAndDivision');
    Route::get('/employee-daily-check/{id}', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'show'])->name('technician.employeepcdailychecksreport.show');    
    Route::post('/employee-daily-check/{year}/{month}/{division}/verify', [\App\Http\Controllers\Technician\EmployeePcDailyCheckReportController::class, 'verify'])->name('technician.employeepcdailychecksreport.verify');
    
    // Lab Usage
    Route::get('/lab-usages', [\App\Http\Controllers\Technician\LabUsageMonthlyReportController::class, 'index'])->name('technician.labusagesreport.index');    
    Route::get('/lab-usages/{year}/{month}/{lab}', [\App\Http\Controllers\Technician\LabUsageMonthlyReportController::class, 'showByIndex'])
            ->name('technician.labusagesreport.showByIndex');
    Route::get('/lab-usages/{id}', [\App\Http\Controllers\Technician\LabUsageMonthlyReportController::class, 'show'])->name('technician.labusagesreport.show');    
    Route::post('/lab-usages/{year}/{month}/{lab}/verify', [\App\Http\Controllers\Technician\LabUsageMonthlyReportController::class, 'verify'])->name('technician.labusagesreport.verify');
    Route::get('/lab-usages/{year}/{month}/{lab}/print', [\App\Http\Controllers\Technician\LabUsageMonthlyReportController::class, 'print'])->name('technician.labusagesreport.print');

    // Lab Request
    Route::get('/lab-requests', [\App\Http\Controllers\Technician\LabRequestMonthlyReportController::class, 'index'])->name('technician.labrequestsreport.index');    
    Route::get('/lab-requests/{year}/{month}/{lab}', [\App\Http\Controllers\Technician\LabRequestMonthlyReportController::class, 'showByIndex'])
            ->name('technician.labrequestsreport.showByIndex');
    Route::get('/lab-requests/{id}', [\App\Http\Controllers\Technician\LabRequestMonthlyReportController::class, 'show'])->name('technician.labrequestsreport.show');    
    Route::post('/lab-requests/{year}/{month}/{lab}/verify', [\App\Http\Controllers\Technician\LabRequestMonthlyReportController::class, 'verify'])->name('technician.labrequestsreport.verify');
    
    // Lab Daily Check
    Route::get('/lab-daily-check', [\App\Http\Controllers\Technician\LabDailyCheckMonthlyReportController::class, 'index'])->name('technician.labdailychecksreport.index');    
    Route::get('/lab-daily-check/{year}/{month}/{lab}', [\App\Http\Controllers\Technician\LabDailyCheckMonthlyReportController::class, 'showByIndex'])
            ->name('technician.labdailychecksreport.showByIndex');
    Route::get('/lab-daily-check/{id}', [\App\Http\Controllers\Technician\LabDailyCheckMonthlyReportController::class, 'show'])->name('technician.labdailychecksreport.show');    
    Route::post('/lab-daily-check/{year}/{month}/{lab}/verify', [\App\Http\Controllers\Technician\LabDailyCheckMonthlyReportController::class, 'verify'])->name('technician.labdailychecksreport.verify');
    
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

    //Web Assignment
    Route::resource('/web-assignment', \App\Http\Controllers\Puskom\WebAssignmentController::class)->names('puskom.webassignment');
    Route::patch('/web-assignment/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\WebAssignmentController::class, 'markAsComplete'])->name('puskom.webassignment.markAsComplete');

    //Network Assignment
    Route::resource('/network-assignment', \App\Http\Controllers\Puskom\NetworkAssignmentController::class)->names('puskom.networkassignment');
    Route::patch('/network-assignment/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\NetworkAssignmentController::class, 'markAsComplete'])->name('puskom.networkassignment.markAsComplete');
    
    //Web Maintenance
    Route::resource('/web-maintenance', \App\Http\Controllers\Puskom\WebMaintenanceController::class)->names('puskom.webmaintenance');
    Route::patch('/web-maintenance/{id}/mark-as-complete', [\App\Http\Controllers\Puskom\WebMaintenanceController::class, 'markAsComplete'])->name('puskom.webmaintenance.markAsComplete');

    //App Check
    Route::resource('/app-checking', \App\Http\Controllers\Puskom\AppCheckingController::class)->names('puskom.appchecking');
    
    //Wifi Check
    Route::resource('/wifi-checking', \App\Http\Controllers\Puskom\WifiCheckingController::class)->names('puskom.wifichecking');

    // Report Network Troubleshooting
    Route::get('/report/network-troubleshooting', [\App\Http\Controllers\Puskom\NetworkTroubleshootingMonthlyReportController::class, 'index'])->name('puskom.networktroubleshootingsreport.index');    
    Route::get('/report/network-troubleshooting/{year}/{month}', [\App\Http\Controllers\Puskom\NetworkTroubleshootingMonthlyReportController::class, 'showByIndex'])
            ->name('puskom.networktroubleshootingsreport.showByIndex');
    Route::get('/report/network-troubleshooting/{id}', [\App\Http\Controllers\Puskom\NetworkTroubleshootingMonthlyReportController::class, 'show'])->name('puskom.networktroubleshootingsreport.show');    
    Route::post('/report/network-troubleshooting/{year}/{month}/verify', [\App\Http\Controllers\Puskom\NetworkTroubleshootingMonthlyReportController::class, 'verify'])->name('puskom.networktroubleshootingsreport.verify');

    // Network Development Report
    Route::get('/report/network-development', [\App\Http\Controllers\Puskom\NetworkDevelopmentReportController::class, 'index'])->name('puskom.networkdevreport.index');    
    Route::get('/report/network-development/{year}/{month}', [\App\Http\Controllers\Puskom\NetworkDevelopmentReportController::class, 'showByIndex'])
            ->name('puskom.networkdevreport.showByIndex');
    Route::get('/report/network-development/{id}', [\App\Http\Controllers\Puskom\NetworkDevelopmentReportController::class, 'show'])->name('puskom.networkdevreport.show');    
    Route::post('/report/network-development/{year}/{month}/verify', [\App\Http\Controllers\Puskom\NetworkDevelopmentReportController::class, 'verify'])->name('puskom.networkdevreport.verify');
    
    // Web Development
    Route::get('/report/web-development', [\App\Http\Controllers\Puskom\WebDevelopmentMonthlyReportController::class, 'index'])->name('puskom.webdevelopmentsreport.index');    
    Route::get('/report/web-development/{year}', [\App\Http\Controllers\Puskom\WebDevelopmentMonthlyReportController::class, 'showByIndex'])
            ->name('puskom.webdevelopmentsreport.showByIndex');
    Route::get('/report/web-development/detail/{id}', [\App\Http\Controllers\Puskom\WebDevelopmentMonthlyReportController::class, 'show'])->name('puskom.webdevelopmentsreport.show');    
    Route::post('/report/web-development/{year}/verify', [\App\Http\Controllers\Puskom\WebDevelopmentMonthlyReportController::class, 'verify'])->name('puskom.webdevelopmentsreport.verify');

    // Web Maintenance
    Route::get('/report/web-maintenance', [\App\Http\Controllers\Puskom\WebMaintenanceReportController::class, 'index'])->name('puskom.webmaintenancesreport.index');    
    Route::get('/report/web-maintenance/{year}', [\App\Http\Controllers\Puskom\WebMaintenanceReportController::class, 'showByIndex'])
            ->name('puskom.webmaintenancesreport.showByIndex');
    Route::get('/report/web-maintenance/detail/{id}', [\App\Http\Controllers\Puskom\WebMaintenanceReportController::class, 'show'])->name('puskom.webmaintenancesreport.show');    
    Route::post('/report/web-maintenance/{year}/verify', [\App\Http\Controllers\Puskom\WebMaintenanceReportController::class, 'verify'])->name('puskom.webmaintenancesreport.verify');
    
    // Web Checking
    Route::get('/report/wifi-checking', [\App\Http\Controllers\Puskom\WifiCheckingReportController::class, 'index'])->name('puskom.wificheckingsreport.index');    
    Route::get('/report/wifi-checking/{building}', [\App\Http\Controllers\Puskom\WifiCheckingReportController::class, 'showByIndex'])
            ->name('puskom.wificheckingsreport.showByIndex');
    Route::get('/report/wifi-checking/detail/{id}', [\App\Http\Controllers\Puskom\WifiCheckingReportController::class, 'show'])->name('puskom.wificheckingsreport.show');    
    Route::post('/report/wifi-checking/{id}/verify', [\App\Http\Controllers\Puskom\WifiCheckingReportController::class, 'verify'])->name('puskom.wificheckingsreport.verify');

    // App Checking
    Route::get('/report/web-checking', [\App\Http\Controllers\Puskom\AppCheckingReportController::class, 'index'])->name('puskom.appcheckingsreport.index');    
    Route::get('/report/web-checking/detail/{id}', [\App\Http\Controllers\Puskom\AppCheckingReportController::class, 'show'])->name('puskom.appcheckingsreport.show');    
    Route::post('/report/web-checking/{id}/verify', [\App\Http\Controllers\Puskom\AppCheckingReportController::class, 'verify'])->name('puskom.appcheckingsreport.verify');

    // Web Assignment Report
    Route::get('/report/web-assignment', [\App\Http\Controllers\Puskom\WebAssignmentReportController::class, 'index'])->name('puskom.webassignmentreport.index');    
    Route::get('/report/web-assignment/{year}', [\App\Http\Controllers\Puskom\WebAssignmentReportController::class, 'showByIndex'])
            ->name('puskom.webassignmentreport.showByIndex');
    Route::get('/report/web-assignment/detail/{id}', [\App\Http\Controllers\Puskom\WebAssignmentReportController::class, 'show'])->name('puskom.webassignmentreport.show');    
    Route::post('/report/web-assignment/{year}/verify', [\App\Http\Controllers\Puskom\WebAssignmentReportController::class, 'verify'])->name('puskom.webassignmentreport.verify');

    // Network Assignment Report
    Route::get('/network/network-assignment', [\App\Http\Controllers\Puskom\NetworkAssignmentReportController::class, 'index'])->name('puskom.networkassignmentreport.index');    
    Route::get('/network/network-assignment/{year}', [\App\Http\Controllers\Puskom\NetworkAssignmentReportController::class, 'showByIndex'])
            ->name('puskom.networkassignmentreport.showByIndex');
    Route::get('/network/network-assignment/detail/{id}', [\App\Http\Controllers\Puskom\NetworkAssignmentReportController::class, 'show'])->name('puskom.networkassignmentreport.show');    
    Route::post('/network/network-assignment/{year}/verify', [\App\Http\Controllers\Puskom\NetworkAssignmentReportController::class, 'verify'])->name('puskom.networkassignmentreport.verify');
    
});

// Wakil Rektor 1
Route::prefix('vicerector')->middleware('checkRole:9')->group(function () {
        // Wifi Checking
    Route::get('/wifi-checking', [\App\Http\Controllers\ViceRector\WifiCheckingReportController::class, 'index'])->name('vicerector.wificheckingsreport.index');    
    Route::get('/wifi-checking/{building}', [\App\Http\Controllers\ViceRector\WifiCheckingReportController::class, 'showByIndex'])
                ->name('vicerector.wificheckingsreport.showByIndex');
    Route::get('/wifi-checking/detail/{id}', [\App\Http\Controllers\ViceRector\WifiCheckingReportController::class, 'show'])->name('vicerector.wificheckingsreport.show');    
    Route::post('/wifi-checking/{id}/verify', [\App\Http\Controllers\ViceRector\WifiCheckingReportController::class, 'verify'])->name('vicerector.wificheckingsreport.verify');

        // App Checking
    Route::get('/web-checking', [\App\Http\Controllers\ViceRector\AppCheckingReportController::class, 'index'])->name('vicerector.appcheckingsreport.index');    
    Route::get('/web-checking/detail/{id}', [\App\Http\Controllers\ViceRector\AppCheckingReportController::class, 'show'])->name('vicerector.appcheckingsreport.show');    
    Route::post('/web-checking/{id}/verify', [\App\Http\Controllers\ViceRector\AppCheckingReportController::class, 'verify'])->name('vicerector.appcheckingsreport.verify');

    // Web Maintenance
    Route::get('/web-maintenance', [\App\Http\Controllers\ViceRector\WebMaintenanceReportController::class, 'index'])->name('vicerector.webmaintenancesreport.index');    
    Route::get('/web-maintenance/{year}', [\App\Http\Controllers\ViceRector\WebMaintenanceReportController::class, 'showByIndex'])
            ->name('vicerector.webmaintenancesreport.showByIndex');
    Route::get('/web-maintenance/detail/{id}', [\App\Http\Controllers\ViceRector\WebMaintenanceReportController::class, 'show'])->name('vicerector.webmaintenancesreport.show');    
    Route::post('/web-maintenance/{year}/verify', [\App\Http\Controllers\ViceRector\WebMaintenanceReportController::class, 'verify'])->name('vicerector.webmaintenancesreport.verify');

    // Web Development
    Route::get('/web-development', [\App\Http\Controllers\ViceRector\WebDevelopmentMonthlyReportController::class, 'index'])->name('vicerector.webdevelopmentsreport.index');    
    Route::get('/web-development/{year}', [\App\Http\Controllers\ViceRector\WebDevelopmentMonthlyReportController::class, 'showByIndex'])
            ->name('vicerector.webdevelopmentsreport.showByIndex');
    Route::get('/web-development/detail/{id}', [\App\Http\Controllers\ViceRector\WebDevelopmentMonthlyReportController::class, 'show'])->name('vicerector.webdevelopmentsreport.show');    
    Route::post('/web-development/{year}/verify', [\App\Http\Controllers\ViceRector\WebDevelopmentMonthlyReportController::class, 'verify'])->name('vicerector.webdevelopmentsreport.verify');

    // Network Troubleshooting
    Route::get('/network-troubleshooting', [\App\Http\Controllers\ViceRector\NetworkTroubleshootingMonthlyReportController::class, 'index'])->name('vicerector.networktroubleshootingsreport.index');    
    Route::get('/network-troubleshooting/{year}/{month}', [\App\Http\Controllers\ViceRector\NetworkTroubleshootingMonthlyReportController::class, 'showByIndex'])
            ->name('vicerector.networktroubleshootingsreport.showByIndex');
    Route::get('/network-troubleshooting/{id}', [\App\Http\Controllers\ViceRector\NetworkTroubleshootingMonthlyReportController::class, 'show'])->name('vicerector.networktroubleshootingsreport.show');    
    Route::post('/network-troubleshooting/{year}/{month}/verify', [\App\Http\Controllers\ViceRector\NetworkTroubleshootingMonthlyReportController::class, 'verify'])->name('vicerector.networktroubleshootingsreport.verify');

    // Network Development Report
    Route::get('/network-development', [\App\Http\Controllers\ViceRector\NetworkDevelopmentReportController::class, 'index'])->name('vicerector.networkdevreport.index');    
    Route::get('/network-development/{year}/{month}', [\App\Http\Controllers\ViceRector\NetworkDevelopmentReportController::class, 'showByIndex'])
            ->name('vicerector.networkdevreport.showByIndex');
    Route::get('/network-development/{id}', [\App\Http\Controllers\ViceRector\NetworkDevelopmentReportController::class, 'show'])->name('vicerector.networkdevreport.show');    
    Route::post('/network-development/{year}/{month}/verify', [\App\Http\Controllers\ViceRector\NetworkDevelopmentReportController::class, 'verify'])->name('vicerector.networkdevreport.verify');

    // Web Assignment Report
    Route::get('/web-assignment', [\App\Http\Controllers\ViceRector\WebAssignmentReportController::class, 'index'])->name('vicerector.webassignmentreport.index');    
    Route::get('/web-assignment/{year}', [\App\Http\Controllers\ViceRector\WebAssignmentReportController::class, 'showByIndex'])
            ->name('vicerector.webassignmentreport.showByIndex');
    Route::get('/web-assignment/detail/{id}', [\App\Http\Controllers\ViceRector\WebAssignmentReportController::class, 'show'])->name('vicerector.webassignmentreport.show');    
    Route::post('/web-assignment/{year}/verify', [\App\Http\Controllers\ViceRector\WebAssignmentReportController::class, 'verify'])->name('vicerector.webassignmentreport.verify');
    
    // Network Assignment Report
    Route::get('/network-assignment', [\App\Http\Controllers\ViceRector\NetworkAssignmentReportController::class, 'index'])->name('vicerector.networkassignmentreport.index');    
    Route::get('/network-assignment/{year}', [\App\Http\Controllers\ViceRector\NetworkAssignmentReportController::class, 'showByIndex'])
            ->name('vicerector.networkassignmentreport.showByIndex');
    Route::get('/network-assignment/detail/{id}', [\App\Http\Controllers\ViceRector\NetworkAssignmentReportController::class, 'show'])->name('vicerector.networkassignmentreport.show');    
    Route::post('/network-assignment/{year}/verify', [\App\Http\Controllers\ViceRector\NetworkAssignmentReportController::class, 'verify'])->name('vicerector.networkassignmentreport.verify');
    
});

// Wakil Rektor 2
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

    // Lab Request
    Route::get('/lab-requests', [\App\Http\Controllers\ViceRector\LabRequestMonthlyReportController::class, 'index'])->name('vicerector.labrequestsreport.index');    
    Route::get('/lab-requests/{year}/{month}/{lab}', [\App\Http\Controllers\ViceRector\LabRequestMonthlyReportController::class, 'showByIndex'])
            ->name('vicerector.labrequestsreport.showByIndex');
    Route::get('/lab-requests/{id}', [\App\Http\Controllers\ViceRector\LabRequestMonthlyReportController::class, 'show'])->name('vicerector.labrequestsreport.show');    
    Route::post('/lab-requests/{year}/{month}/{lab}/verify', [\App\Http\Controllers\ViceRector\LabRequestMonthlyReportController::class, 'verify'])->name('vicerector.labrequestsreport.verify');
    
    // Lab Daily Check
    Route::get('/lab-daily-check', [\App\Http\Controllers\ViceRector\LabDailyCheckMonthlyReportController::class, 'index'])->name('vicerector.labdailychecksreport.index');    
    Route::get('/lab-daily-check/{year}/{month}/{lab}', [\App\Http\Controllers\ViceRector\LabDailyCheckMonthlyReportController::class, 'showByIndex'])
            ->name('vicerector.labdailychecksreport.showByIndex');
    Route::get('/lab-daily-check/{id}', [\App\Http\Controllers\ViceRector\LabDailyCheckMonthlyReportController::class, 'show'])->name('vicerector.labdailychecksreport.show');    
    Route::post('/lab-daily-check/{year}/{month}/{lab}/verify', [\App\Http\Controllers\ViceRector\LabDailyCheckMonthlyReportController::class, 'verify'])->name('vicerector.labdailychecksreport.verify');
});


Route::prefix('programmer')->middleware('checkRole:10')->group(function () {
    Route::get('/web-assignment', [\App\Http\Controllers\Programmer\WebAssignmentController::class, 'index'])->name('programmer.webassignment.index');
    Route::post('/web-assignment/{id}/verify', [\App\Http\Controllers\Programmer\WebAssignmentController::class, 'verify'])->name('programmer.webassignment.verify');
});

Route::prefix('engineer')->middleware('checkRole:11')->group(function () {
    Route::get('/network-assignment', [\App\Http\Controllers\Engineer\NetworkAssignmentController::class, 'index'])->name('engineer.networkassignment.index');
    Route::post('/network-assignment/{id}/verify', [\App\Http\Controllers\Engineer\NetworkAssignmentController::class, 'verify'])->name('engineer.networkassignment.verify');
});

Route::prefix('headassistantlab')->middleware('checkRole:12')->group(function () {
    // Lab Usage
    Route::get('/lab-usages', [\App\Http\Controllers\HeadAslab\LabUsageMonthlyReportController::class, 'index'])->name('headaslab.labusagesreport.index');    
    Route::get('/lab-usages/{year}/{month}/', [\App\Http\Controllers\HeadAslab\LabUsageMonthlyReportController::class, 'showByIndex'])
        ->name('headaslab.labusagesreport.showByIndex');
    Route::get('/lab-usages/{id}', [\App\Http\Controllers\HeadAslab\LabUsageMonthlyReportController::class, 'show'])->name('headaslab.labusagesreport.show');    
    Route::post('/lab-usages/{year}/{month}/verify', [\App\Http\Controllers\HeadAslab\LabUsageMonthlyReportController::class, 'verify'])->name('headaslab.labusagesreport.verify');

    // Lab Usage
    Route::get('/lab-request', [\App\Http\Controllers\HeadAslab\LabRequestMonthlyReportController::class, 'index'])->name('headaslab.labrequestsreport.index');    
    Route::get('/lab-request/{year}/{month}/', [\App\Http\Controllers\HeadAslab\LabRequestMonthlyReportController::class, 'showByIndex'])
        ->name('headaslab.labrequestsreport.showByIndex');
    Route::get('/lab-request/{id}', [\App\Http\Controllers\HeadAslab\LabRequestMonthlyReportController::class, 'show'])->name('headaslab.labrequestsreport.show');    
    Route::post('/lab-request/{year}/{month}/verify', [\App\Http\Controllers\HeadAslab\LabRequestMonthlyReportController::class, 'verify'])->name('headaslab.labrequestsreport.verify');
    
});



// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
});
