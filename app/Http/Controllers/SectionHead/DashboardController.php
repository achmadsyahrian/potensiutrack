<?php

namespace App\Http\Controllers\SectionHead;

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
    public function index()
    {

      // Verif
      $repairRequestVerifCount = RepairRequest::where('status', 3)->get()->count();
      $networkAssVerifCount = NetworkAssignment::whereNotNull('finish_date')->whereNull('kabag_signature')->get()->count();
      $webAssVerifCount = WebAssignment::whereNotNull('finish_date')->whereNull('kabag_signature')->get()->count();

      // Laporan
      $labCheckingCount = $this->getLabCheckingCount('kabag_signature');
      $labRequestCount = $this->getLabRequestCount('kabag_signature');
      $labUsageCount = $this->getLabUsageCount('kabag_signature');

      $networkDevCount = $this->getNetworkDevCount('kabag_signature');
      $wifiCheckingCount = WifiChecking::whereNull('kabag_signature')->get()->count();
      $networkTroCount = $this->getNetworkTroCount('kabag_signature');
      $networkAssCount = $this->getNetworkAssCount('kabag_signature');

      $webDevCount = $this->getWebDevCount('kabag_signature');
      $webChekingCount = $this->getWebChekingCount('kabag_signature');
      $webMaintenanceCount = $this->getWebMaintenanceCount('kabag_signature');
      $webAssCount = $this->getWebAssCount('kabag_signature');

      $repairRequestCount = RepairRequestReport::all()->count();
      $repairRequestReportCount = $this->getRepairRequestReportCount('kabag_signature');

      $employeePcDailyCheck = EmployeePcDailyCheckMonthlyReport::all()->count();
      $employeePcDailyCheckReportCount = $this->getEmployeePcCheckingCount('kabag_signature');

      
      return view('index', compact(
         'repairRequestVerifCount', 'networkAssVerifCount', 'webAssVerifCount',
         'labCheckingCount', 'labRequestCount', 'labUsageCount',
         'networkDevCount', 'wifiCheckingCount', 'networkTroCount', 'networkAssCount',
         'webDevCount', 'webChekingCount', 'webMaintenanceCount', 'webAssCount',
         'repairRequestCount', 'repairRequestReportCount', 'employeePcDailyCheck', 'employeePcDailyCheckReportCount'
      ));
    }
    
}
