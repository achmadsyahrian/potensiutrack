<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\LabDailyCheckMonthlyReport;
use App\Models\LabRequestMonthlyReport;
use App\Models\LabUsageMonthlyReport;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

      // Perawatan & Perbaikan
      $repairRequestCount = RepairRequest::all()->count();
      $repairRequestNewCount = RepairRequest::where('status', 1)->count();
      $repairRequestFinishCount = RepairRequest::where('status', 2)->count();
      $repairRequestConfirmCount = RepairRequest::where('status', 3)->count();
      $repairRequestApproveCount = RepairRequest::where('status', 4)->count();
      $repairRequestRejectCount = RepairRequest::where('status', 5)->count();
      
      $repairRequestLatest = RepairRequest::latest()->limit(10)->get();

      // Lab
      $labRequestReportCount = LabRequestMonthlyReport::all()->count();
      $labRequestReportUncheckCount = LabRequestMonthlyReport::whereNull('teknisi_signature')->count();

      $labUsageReportCount = LabUsageMonthlyReport::all()->count();
      $labUsageReportUncheckCount = LabUsageMonthlyReport::whereNull('teknisi_signature')->count();

      $labDailyCheckReportCount = LabDailyCheckMonthlyReport::all()->count();
      $labDailyCheckReportUncheckCount = LabDailyCheckMonthlyReport::whereNull('teknisi_signature')->count();

      return view('index', compact(
         'repairRequestCount', 'repairRequestFinishCount', 'repairRequestConfirmCount', 'repairRequestApproveCount', 'repairRequestNewCount', 'repairRequestRejectCount', 'repairRequestLatest', 
         'labRequestReportCount', 'labUsageReportCount', 'labDailyCheckReportCount',
         'labRequestReportUncheckCount', 'labUsageReportUncheckCount', 'labDailyCheckReportUncheckCount'
      ));
    }
}
