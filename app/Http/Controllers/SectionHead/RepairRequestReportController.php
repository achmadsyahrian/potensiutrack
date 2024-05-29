<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairRequestReportController extends Controller
{
    public function index(Request $request)
    {
        $data = RepairRequest::select(DB::raw('YEAR(date) as year, MONTH(date) as month, COUNT(*) as count'))
            ->where('status', 4)
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('section_head.repair_request_report.index', compact('data'));
    }

    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = RepairRequest::whereYear('date', $year)
            ->where('status', 4)
            ->whereMonth('date', $monthInNumber)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.repair_request_report.show_by_index', compact('data', 'year', 'month'));
    }

    public function show(RepairRequest $id)
    {
        $repairRequest = $id;
        return view('section_head.repair_request_report.show', compact('repairRequest'));
    }

    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = RepairRequestReport::updateOrCreate(
            ['year' => $year, 'month' => $monthResult],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
    
}
