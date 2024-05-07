<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebMaintenanceReportController extends Controller
{
    public function index(Request $request)
    {
        $data = WebMaintenance::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->where('status', 3) 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('section_head.web_maintenance_report.index', compact('data'));
    }


    public function showByIndex($year)
    {

        $data = WebMaintenance::whereYear('date', $year)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.web_maintenance_report.show_by_index', compact('data', 'year'));
    }


    public function show(WebMaintenance $id)
    {
        $web_maintenance = $id;
        return view('section_head.web_maintenance_report.show', compact('web_maintenance'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = WebMaintenanceReport::updateOrCreate(
            ['year' => $year],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
