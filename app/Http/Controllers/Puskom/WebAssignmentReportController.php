<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\WebAssignment;
use App\Models\WebAssignmentReport;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebAssignmentReportController extends Controller
{
    public function index(Request $request)
    {
        $data = WebAssignment::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->whereNotNull('finish_date') 
            ->whereNotNull('programmer_signature') 
            ->whereNotNull('kabag_signature') 
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('puskom.report.web_assignment.index', compact('data'));
    }


    public function showByIndex($year)
    {

        $data = WebAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->whereNotNull('programmer_signature') 
            ->whereNotNull('kabag_signature') 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('puskom.report.web_assignment.show_by_index', compact('data', 'year'));
    }


    public function show(WebAssignment $id)
    {
        $web_maintenance = $id;
        return view('puskom.report.web_assignment.show', compact('web_maintenance'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = WebAssignmentReport::updateOrCreate(
            ['year' => $year],
            ['puskom_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }

    public function print($year)
    {

        $data = WebAssignment::whereYear('date', $year)
            ->whereNotNull('finish_date') 
            ->whereNotNull('programmer_signature') 
            ->whereNotNull('kabag_signature') 
            ->orderBy('date', 'asc')
            ->get();

        $dataReport = WebAssignmentReport::where('year', $year)->first();

        $chunkedData = $data->chunk(10);

        $html = view('puskom.report.web_assignment.print', [
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
