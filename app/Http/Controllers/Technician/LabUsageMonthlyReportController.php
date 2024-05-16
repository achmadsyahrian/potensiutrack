<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabUsage;
use App\Models\LabUsageMonthlyReport;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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

    public function print($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabUsage::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->paginate(10);
        $labName = Lab::find($lab)->pluck('name')->first();

        $dataReport = LabUsageMonthlyReport::where('lab_id', $lab)
                    ->where('year', $year)
                    ->where('month', $monthInNumber)
                    ->first();

        return view('technician.lab_usages_report.print', compact('data', 'year', 'month', 'labName', 'dataReport'));
    }


    // =================================================================

    public function print2($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabUsage::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->get();

        $labName = Lab::where('id', $lab)->pluck('name')->first();

        $dataReport = LabUsageMonthlyReport::where('lab_id', $lab)
            ->where('year', $year)
            ->where('month', $monthInNumber)
            ->first();

        $chunkedData = $data->chunk(6);

        $html = view('technician.lab_usages_report.print2', [
            'chunkedData' => $chunkedData,
            'labName' => $labName,
            'dataReport' => $dataReport,
            'year' => $year,
            'month' => $month
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();

        return response()->streamDownload(
            fn () => print($output),
            "report.pdf",
            ["Content-Type" => "application/pdf"]
        );
    }

    public function print3($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabUsage::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->get();

        $labName = Lab::where('id', $lab)->pluck('name')->first();

        $dataReport = LabUsageMonthlyReport::where('lab_id', $lab)
            ->where('year', $year)
            ->where('month', $monthInNumber)
            ->first();

        $chunkedData = $data->chunk(7);

        $html = view('technician.lab_usages_report.print3', [
            'chunkedData' => $chunkedData,
            'labName' => $labName,
            'dataReport' => $dataReport,
            'year' => $year,
            'month' => $month
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();

        return response()->stream(
            fn () => print($output),
            200,
            [
                "Content-Type" => "application/pdf",
                "Content-Disposition" => "inline; filename=document.pdf"
            ]
        );
        
    }

    
}
