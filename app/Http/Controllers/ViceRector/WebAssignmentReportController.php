<?php

namespace App\Http\Controllers\ViceRector;

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
            ->whereNotNull('programmer_signature') 
            ->whereNotNull('kabag_signature') 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('vice_rector.web_assignment_report.index', compact('data'));
    }


    public function showByIndex($year)
    {

        $data = WebAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->whereNotNull('programmer_signature') 
            ->whereNotNull('kabag_signature') 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('vice_rector.web_assignment_report.show_by_index', compact('data', 'year'));
    }


    public function show(WebAssignment $id)
    {
        $web_maintenance = $id;
        return view('vice_rector.web_assignment_report.show', compact('web_maintenance'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'wakil_rektor_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['wakil_rektor_signature']);

        $monthlyReport = WebAssignmentReport::updateOrCreate(
            ['year' => $year],
            ['wakil_rektor_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
