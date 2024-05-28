<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\NetworkTroubleshooting;
use App\Models\NetworkTroubleshootingMonthlyReport;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkTroubleshootingMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = NetworkTroubleshooting::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->where('status', 3)
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('puskom.report.network_troubleshooting.index', compact('data'));
    }


    public function showByIndex($year)
    {
        $data = NetworkTroubleshooting::whereYear('date', $year)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('puskom.report.network_troubleshooting.show_by_index', compact('data', 'year'));
    }


    public function show(NetworkTroubleshooting $id)
    {
        $networkTroubleshooting = $id;
        return view('puskom.report.network_troubleshooting.show', compact('networkTroubleshooting'));
    }


    public function verify(Request $request, $year)
    {

        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = NetworkTroubleshootingMonthlyReport::updateOrCreate(
            ['year' => $year],
            ['puskom_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }


    public function print($year)
    {

        $data = NetworkTroubleshooting::whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        $dataReport = NetworkTroubleshootingMonthlyReport::where('year', $year)->first();

        $chunkedData = $data->chunk(10);

        $html = view('puskom.report.network_troubleshooting.print', [
            'chunkedData' => $chunkedData,
            'dataReport' => $dataReport,
            'year' => $year,
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
