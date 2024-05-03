<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabUsage;
use App\Models\LabUsageMonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabUsageMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = LabUsage::select(DB::raw('YEAR(date) as year, MONTH(date) as month, lab_id, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'lab_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('technician.lab_usages_report.index', compact('data'));
    }

    public function showByIndex($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabUsage::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->paginate(10);
        $labName = Lab::find($lab)->pluck('name')->first();

        return view('technician.lab_usages_report.show_by_index', compact('data', 'year', 'month', 'labName'));
    }

    public function show(LabUsage $id)
    {
        $labUsage = $id;
        return view('technician.lab_usages_report.show', compact('labUsage'));
    }


    public function verify(Request $request, $year, $month, $lab)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'teknisi_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['teknisi_signature']);

        $monthlyReport = LabUsageMonthlyReport::updateOrCreate(
            ['lab_id' => $lab, 'year' => $year, 'month' => $monthResult],
            ['teknisi_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
