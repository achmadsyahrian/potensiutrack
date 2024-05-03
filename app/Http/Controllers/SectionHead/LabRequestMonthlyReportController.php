<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabRequest;
use App\Models\LabRequestMonthlyReport;
use App\Models\LabUsage;
use App\Models\LabUsageMonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabRequestMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = LabRequest::select(DB::raw('YEAR(date) as year, MONTH(date) as month, lab_id, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'lab_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('section_head.lab_requests_report.index', compact('data'));
    }

    public function showByIndex($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabRequest::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->paginate(10);

        $labName = Lab::find($lab)->name;
        return view('section_head.lab_requests_report.show_by_index', compact('data', 'year', 'month', 'labName'));
    }

    public function show(LabRequest $id)
    {
        $labRequest = $id;
        return view('section_head.lab_requests_report.show', compact('labRequest'));
    }


    public function verify(Request $request, $year, $month, $lab)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = LabRequestMonthlyReport::updateOrCreate(
            ['lab_id' => $lab, 'year' => $year, 'month' => $monthResult],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
