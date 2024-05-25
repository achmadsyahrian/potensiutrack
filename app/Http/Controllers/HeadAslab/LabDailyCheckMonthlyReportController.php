<?php

namespace App\Http\Controllers\HeadAslab;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabDailyCheck;
use App\Models\LabDailyCheckMonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabDailyCheckMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $labId = auth()->user()->headLabAssistant->lab_id;
        
        $data = LabDailyCheck::select(DB::raw('YEAR(date) as year, MONTH(date) as month, lab_id, COUNT(*) as count'))
            ->where('lab_id', $labId)
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'lab_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('head_aslab.lab_dailychecks_report.index', compact('data'));
    }

    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);
        $labId = auth()->user()->headLabAssistant->lab_id;

        $data = LabDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $labId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        $labName = Lab::find($labId)->name;
        return view('head_aslab.lab_dailychecks_report.show_by_index', compact('data', 'year', 'month', 'labName'));
    }

    public function show(LabDailyCheck $id)
    {
        $labDailyCheck = $id;
        return view('head_aslab.lab_dailychecks_report.show', compact('labDailyCheck'));
    }


    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);
        $labId = auth()->user()->headLabAssistant->lab_id;

        $validated = $request->validate([
            'kepala_aslab_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kepala_aslab_signature']);

        $monthlyReport = LabDailyCheckMonthlyReport::updateOrCreate(
            ['lab_id' => $labId, 'year' => $year, 'month' => $monthResult],
            ['kepala_aslab_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
