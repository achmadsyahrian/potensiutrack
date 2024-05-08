<?php

namespace App\Http\Controllers\ViceRector;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\Building;
use App\Models\WebApp;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppCheckingReportController extends Controller
{
    public function index(Request $request)
    {
        $data = AppChecking::paginate(10);

        return view('vice_rector.app_checking_report.index', compact('data'));
    }


    public function show(AppChecking $id)
    {
        $appChecking = $id;
        $webApps = WebApp::all();
        return view('vice_rector.app_checking_report.show', compact('appChecking', 'webApps'));
    }


    public function verify(Request $request, AppChecking $id)
    {
        $validated = $request->validate([
            'wakil_rektor_signature' => 'required',
        ]);

        $kabagSignature = $this->saveSignature($validated['wakil_rektor_signature']);

        $id->wakil_rektor_signature = $kabagSignature;
        $id->save();

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
