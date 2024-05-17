<?php

namespace App\Http\Controllers\HeadAslab;

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
        $labId = auth()->user()->headLabAssistant->lab_id;

        $data = LabUsage::select(DB::raw('YEAR(date) as year, MONTH(date) as month, lab_id, COUNT(*) as count'))
            ->where('lab_id', $labId)
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'lab_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        // Mengonversi bulan menjadi bahasa Indonesia
        $data = $this->convertMonthToIndonesian($data);

        return view('head_aslab.lab_usages_report.index', compact('data'));
    }


    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);
        $labId = auth()->user()->headLabAssistant->lab_id;

        $data = LabUsage::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $labId)
            ->orderBy('date', 'desc')
            ->paginate(10);
        $labName = Lab::find($labId)->pluck('name')->first();

        return view('head_aslab.lab_usages_report.show_by_index', compact('data', 'year', 'month', 'labName'));
    }

    public function show(LabUsage $id)
    {
        $labUsage = $id;
        return view('head_aslab.lab_usages_report.show', compact('labUsage'));
    }


    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);
        $labId = auth()->user()->headLabAssistant->lab_id;

        $validated = $request->validate([
            'kepala_aslab_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kepala_aslab_signature']);

        $monthlyReport = LabUsageMonthlyReport::updateOrCreate(
            ['lab_id' => $labId, 'year' => $year, 'month' => $monthResult],
            ['kepala_aslab_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
