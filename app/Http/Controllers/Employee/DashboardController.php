<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use App\Models\NetworkAssignment;
use App\Models\NetworkConnectionDevelopment;
use App\Models\NetworkTroubleshooting;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use App\Models\WebAssignment;
use App\Models\WebDevelopmentRequest;
use App\Models\WebMaintenance;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

      $userLog = Auth::user();
      $repairRequestCount = RepairRequest::where('requested_by', $userLog->id)->where('status', 4)->get()->count();
      $repairRequestVerifCount = RepairRequest::where('requested_by', $userLog->id)->where('status', 2)->get()->count();
      
      $networkDevCount = NetworkConnectionDevelopment::where('reported_by_id', $userLog->id)->where('status', 3)->get()->count();
      $networkDevVerifCount = NetworkConnectionDevelopment::where('reported_by_id', $userLog->id)->where('status', 2)->get()->count();

      $networkTroCount = NetworkTroubleshooting::where('reported_by_id', $userLog->id)->where('status', 3)->get()->count();
      $networkTroVerifCount = NetworkTroubleshooting::where('reported_by_id', $userLog->id)->where('status', 2)->get()->count();

      $webDevCount = WebDevelopmentRequest::where('reported_by_id', $userLog->id)->where('status', 3)->get()->count();
      $webDevVerifCount = WebDevelopmentRequest::where('reported_by_id', $userLog->id)->where('status', 2)->get()->count();

      $webMaintenanceCount = WebMaintenance::where('reported_by_id', $userLog->id)->where('status', 3)->get()->count();
      $webMaintenanceVerifCount = WebMaintenance::where('reported_by_id', $userLog->id)->where('status', 2)->get()->count();
      
      
      return view('index', compact(
        'repairRequestCount', 'repairRequestVerifCount',
        'networkDevCount', 'networkDevVerifCount',
        'networkTroCount', 'networkTroVerifCount',
        'webDevCount', 'webDevVerifCount',
        'webMaintenanceCount', 'webMaintenanceVerifCount'
      ));
    }
    
}
