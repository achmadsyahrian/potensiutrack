<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\WebAssignment;
use App\Models\WebAssignmentReport;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebAssignmentReportController extends Controller
{
    public function index(Request $request)
    {
        $data = WebAssignment::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->whereNotNull('finish_date') 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('section_head.web_assignment_report.index', compact('data'));
    }


    public function showByIndex($year)
    {

        $data = WebAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.web_assignment_report.show_by_index', compact('data', 'year'));
    }


    public function show(WebAssignment $id)
    {
        $web_maintenance = $id;
        return view('section_head.web_assignment_report.show', compact('web_maintenance'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = WebAssignmentReport::updateOrCreate(
            ['year' => $year],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
