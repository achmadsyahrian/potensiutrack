<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\NetworkAssignment;
use App\Models\NetworkAssignmentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkAssignmentReportController extends Controller
{
    public function index(Request $request)
    {
        $data = NetworkAssignment::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->whereNotNull('finish_date') 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('section_head.network_assignment_report.index', compact('data'));
    }

    public function showByIndex($year)
    {

        $data = NetworkAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.network_assignment_report.show_by_index', compact('data', 'year'));
    }

    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = NetworkAssignmentReport::updateOrCreate(
            ['year' => $year],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
