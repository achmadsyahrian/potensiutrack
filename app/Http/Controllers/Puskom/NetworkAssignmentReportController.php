<?php

namespace App\Http\Controllers\Puskom;

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
            ->whereNotNull('engineer_signature') 
            ->whereNotNull('kabag_signature') 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('puskom.report.network_assignment.index', compact('data'));
    }

    public function showByIndex($year)
    {

        $data = NetworkAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->whereNotNull('engineer_signature') 
            ->whereNotNull('kabag_signature') 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('puskom.report.network_assignment.show_by_index', compact('data', 'year'));
    }

    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = NetworkAssignmentReport::updateOrCreate(
            ['year' => $year],
            ['puskom_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
