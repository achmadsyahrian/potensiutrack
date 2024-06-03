<?php

namespace App\Http\Controllers\ViceRector;

use App\Http\Controllers\Controller;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use App\Models\NetworkAssignment;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use App\Models\WebAssignment;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index1()
    {
      $networkDevCount = $this->getNetworkDevCount('wakil_rektor_signature');
      $wifiCheckingCount = WifiChecking::whereNull('wakil_rektor_signature')->get()->count();
      $networkTroCount = $this->getNetworkTroCount('wakil_rektor_signature');
      $networkAssCount = $this->getNetworkAssCount('wakil_rektor_signature');

      $webDevCount = $this->getWebDevCount('wakil_rektor_signature');
      $webChekingCount = $this->getWebChekingCount('wakil_rektor_signature');
      $webMaintenanceCount = $this->getWebMaintenanceCount('wakil_rektor_signature');
      $webAssCount = $this->getWebAssCount('wakil_rektor_signature');
      
      return view('index', compact(
         'networkDevCount', 'wifiCheckingCount', 'networkTroCount', 'networkAssCount',
         'webDevCount', 'webChekingCount', 'webMaintenanceCount', 'webAssCount',
      ));
    }

    public function index2()
    {
      // Laporan
      $labCheckingCount = $this->getLabCheckingCount('wakil_rektor_signature');
      $labRequestCount = $this->getLabRequestCount('wakil_rektor_signature');
      $labUsageCount = $this->getLabUsageCount('wakil_rektor_signature');
      $repairRequestCount = RepairRequestReport::all()->count();
      $repairRequestReportCount = $this->getRepairRequestReportCount('wakil_rektor_signature');

      $employeePcDailyCheck = EmployeePcDailyCheckMonthlyReport::all()->count();
      $employeePcDailyCheckReportCount = $this->getEmployeePcCheckingCount('wakil_rektor_signature');

      
      return view('index', compact(
         'labCheckingCount', 'labRequestCount', 'labUsageCount',
         'repairRequestCount', 'repairRequestReportCount', 'employeePcDailyCheck', 'employeePcDailyCheckReportCount'
      ));
    }
    
}
