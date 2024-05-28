<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\WebDevelopmentMonthlyReport;
use App\Models\WebDevelopmentRequest;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebDevelopmentMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = WebDevelopmentRequest::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->where('status', 3) 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('puskom.report.web_development.index', compact('data'));
    }


    public function showByIndex($year)
    {

        $data = WebDevelopmentRequest::whereYear('date', $year)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('puskom.report.web_development.show_by_index', compact('data', 'year'));
    }


    public function show(WebDevelopmentRequest $id)
    {
        $networkTroubleshooting = $id;
        return view('puskom.report.web_development.show', compact('networkTroubleshooting'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = WebDevelopmentMonthlyReport::updateOrCreate(
            ['year' => $year],
            ['puskom_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }

    public function print($year)
    {

        $data = WebDevelopmentRequest::whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        $dataReport = WebDevelopmentMonthlyReport::where('year', $year)->first();

        $chunkedData = $data->chunk(10);

        $html = view('puskom.report.web_development.print', [
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
