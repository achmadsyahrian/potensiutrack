<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\NetworkAssignment;
use App\Models\NetworkConnectionDevelopment;
use App\Models\NetworkTroubleshooting;
use App\Models\User;
use App\Models\WebAssignment;
use App\Models\WebDevelopmentRequest;
use App\Models\WebMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
      // Programmer
      $briyandana = User::findOrFail(8);
      $syahrian = User::findOrFail(9);
      
      // It Administrator
      $irfan = User::findOrFail(10);
      $andra = User::findOrFail(11);
      
      // Pengembangan Jaringan
      $networkDev = NetworkConnectionDevelopment::all();
      $networkDevNew = NetworkConnectionDevelopment::where('status', 1)->count();
      $networkDevCount = NetworkConnectionDevelopment::count();

      // Penanganan Jaringan
      $networkTroubleshooting = NetworkTroubleshooting::all();
      $networkTroubleshootingNew = NetworkTroubleshooting::where('status', 1)->count();
      $networkTroubleshootingCount = NetworkTroubleshooting::count();

      // Pengembangan Web
      $webDev = WebDevelopmentRequest::all();
      $webDevNew = WebDevelopmentRequest::where('status', 1)->count();
      $webDevCount = WebDevelopmentRequest::count();

      // Maintenance Web
      $webMaintenance = WebMaintenance::all();
      $webMaintenanceNew = WebMaintenance::where('status', 1)->count();
      $webMaintenanceCount = WebMaintenance::count();


      // Penugasan Jaringan
      $networkAssIrfanDevCount = NetworkAssignment::where('engineer_id', 10)
         ->where('assignment_type', 'development')
         ->whereNotNull('engineer_signature')
         ->whereNotNull('kabag_signature')
         ->count();

      $networkAssIrfanTrouCount = NetworkAssignment::where('engineer_id', 10)
         ->where('assignment_type', 'troubleshooting')
         ->whereNotNull('engineer_signature')
         ->whereNotNull('kabag_signature')
         ->count();

      $networkAssAndraDevCount = NetworkAssignment::where('engineer_id', 11)
         ->where('assignment_type', 'development')
         ->whereNotNull('engineer_signature')
         ->whereNotNull('kabag_signature')
         ->count();

      $networkAssAndraTrouCount = NetworkAssignment::where('engineer_id', 11)
         ->where('assignment_type', 'troubleshooting')
         ->whereNotNull('engineer_signature')
         ->whereNotNull('kabag_signature')
         ->count();


      // Penugasan Web
      $webAssBriyanDevCount = WebAssignment::where('programmer_id', 8)
         ->where('assignment_type', 'development')
         ->whereNotNull('programmer_signature')
         ->whereNotNull('kabag_signature')
         ->count();
      $webAssBriyanMainCount = WebAssignment::where('programmer_id', 8)
         ->where('assignment_type', 'maintenance')
         ->whereNotNull('programmer_signature')
         ->whereNotNull('kabag_signature')
         ->count();
      $webAssRianDevCount = WebAssignment::where('programmer_id', 9)
         ->where('assignment_type', 'development')
         ->whereNotNull('programmer_signature')
         ->whereNotNull('kabag_signature')
         ->count();
      $webAssRianMainCount = WebAssignment::where('programmer_id', 9)
         ->where('assignment_type', 'maintenance')
         ->whereNotNull('programmer_signature')
         ->whereNotNull('kabag_signature')
         ->count();
      
      
      return view('index', compact(
         'briyandana', 'syahrian', 'irfan', 'andra',
         'networkDev', 'networkDevNew', 'networkDevCount', 
         'networkTroubleshooting', 'networkTroubleshootingNew', 'networkTroubleshootingCount',
         'webDev', 'webDevNew', 'webDevCount',
         'webMaintenance', 'webMaintenanceNew', 'webMaintenanceCount',
         'networkAssIrfanDevCount', 'networkAssIrfanTrouCount', 'networkAssAndraDevCount', 'networkAssAndraTrouCount',
         'webAssBriyanDevCount', 'webAssBriyanMainCount', 'webAssRianDevCount', 'webAssRianMainCount',
      ));
    }
}
