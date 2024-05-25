<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\HeadLabAssistant;
use App\Models\Lab;
use App\Models\LabDailyCheck;
use App\Models\LabDailyCheckMonthlyReport;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabDailyCheckMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = LabDailyCheck::select(DB::raw('YEAR(date) as year, MONTH(date) as month, lab_id, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'lab_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('technician.lab_dailychecks_report.index', compact('data'));
    }

    public function showByIndex($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = LabDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->paginate(10);

        $labName = Lab::find($lab)->name;
        return view('technician.lab_dailychecks_report.show_by_index', compact('data', 'year', 'month', 'labName'));
    }

    public function show(LabDailyCheck $id)
    {
        $labDailyCheck = $id;
        return view('technician.lab_dailychecks_report.show', compact('labDailyCheck'));
    }


    public function verify(Request $request, $year, $month, $lab)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'teknisi_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['teknisi_signature']);

        $monthlyReport = LabDailyCheckMonthlyReport::updateOrCreate(
            ['lab_id' => $lab, 'year' => $year, 'month' => $monthResult],
            ['teknisi_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

    public function print($year, $month, $lab)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $headAssistants = HeadLabAssistant::where('lab_id', $lab)->get();
        foreach ($headAssistants as $headAssistant) {
            $headAssistantsUser = $headAssistant->user->name;
        }

        $data = LabDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('lab_id', $lab)
            ->orderBy('date', 'desc')
            ->get();
        
        $labName = Lab::where('id', $lab)->pluck('name')->first();

        $dataReport = LabDailyCheckMonthlyReport::where('lab_id', $lab)
            ->where('year', $year)
            ->where('month', $monthInNumber)
            ->first();

        // $chunkedData = $data->chunk(7);

        $html = view('technician.lab_dailychecks_report.print', [
            'data' => $data,
            'labName' => $labName,
            'dataReport' => $dataReport,
            'lab' => $lab,
            'year' => $year,
            'month' => $month,
            'pageCount' => 0,
            'monthNumber' => $monthInNumber,
            'headAssistants' => $headAssistantsUser,
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pageCount = $dompdf->getCanvas()->get_page_count();

        session(['pageCount' => $pageCount]);

        $output = $dompdf->output();

        return response()->stream(
            function () use ($output) {
                print($output);
            },
            200,
            [
                "Content-Type" => "application/pdf",
                "Content-Disposition" => "inline; filename=document.pdf",
            ]
        );
    }
}
