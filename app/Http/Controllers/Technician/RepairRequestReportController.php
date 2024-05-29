<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use Dompdf\Dompdf;
use Dompdf\Options;
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

        return view('technician.repair_request_report.index', compact('data'));
    }

    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = RepairRequest::whereYear('date', $year)
            ->where('status', 4)
            ->whereMonth('date', $monthInNumber)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('technician.repair_request_report.show_by_index', compact('data', 'year', 'month'));
    }

    public function show(RepairRequest $id)
    {
        $repairRequest = $id;
        return view('technician.repair_request_report.show', compact('repairRequest'));
    }

    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'teknisi_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['teknisi_signature']);

        $monthlyReport = RepairRequestReport::updateOrCreate(
            ['year' => $year, 'month' => $monthResult],
            ['teknisi_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

    public function print($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = RepairRequest::whereYear('date', $year)
            ->where('status', 4)
            ->whereMonth('date', $monthInNumber)
            ->orderBy('date', 'asc')
            ->get();

        $dataReport = RepairRequestReport::where('year', $year)
            ->where('month', $monthInNumber)
            ->first();

        $chunkedData = $data->chunk(7);

        $html = view('technician.repair_request_report.print', [
            'chunkedData' => $chunkedData,
            'dataReport' => $dataReport,
            'year' => $year,
            'month' => $month,
            'pageCount' => 0,
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
