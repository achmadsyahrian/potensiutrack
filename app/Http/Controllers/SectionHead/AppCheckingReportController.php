<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\AppChekingReport;
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
        $data = AppChecking::select('year', 'month', DB::raw('ANY_VALUE(id) as id'))
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc') 
                            ->orderBy('month', 'desc') 
                            ->paginate(10);

        return view('section_head.app_checking_report.index', compact('data'));
    }
    

    public function show($year, $month)
    {
        $appChecking = AppChecking::where('year', $year)->where('month', $month)->get();
        return view('section_head.app_checking_report.show', compact('appChecking', 'year', 'month'));
    }

    
    public function verify(Request $request, $year, $month)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);

        $signature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = AppChekingReport::updateOrCreate(
            ['year' => $year, 'month' => $month],
            ['kabag_signature' => $signature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
