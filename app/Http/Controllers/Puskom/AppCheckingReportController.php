<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\AppChekingReport;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppCheckingReportController extends Controller
{
    public function index(Request $request)
    {
        $data = AppChecking::select('year', 'month', DB::raw('ANY_VALUE(id) as id'))
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc') 
                            ->orderBy('month', 'desc') 
                            ->paginate(10);

        return view('puskom.report.app_checking.index', compact('data'));
    }




    public function show($year, $month)
    {
        $appChecking = AppChecking::where('year', $year)->where('month', $month)->get();
        return view('puskom.report.app_checking.show', compact('appChecking', 'year', 'month'));
    }


    public function verify(Request $request, $year, $month)
    {
        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);

        $signature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = AppChekingReport::updateOrCreate(
            ['year' => $year, 'month' => $month],
            ['puskom_signature' => $signature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

    public function print($year, $month)
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $months[$month];

        $daysInMonth = Carbon::createFromDate($year, $month)->daysInMonth;

        $data = AppChecking::where('year', $year)
            ->where('month', $month)
            ->get();

        $dataReport = AppChekingReport::where('year', $year)
                    ->where('month', $month)
                    ->first();

        $chunkedData = $data->chunk(3);
        // dd($chunkedData);
        $html = view('puskom.report.app_checking.print', [
            'chunkedData' => $chunkedData,
            'dataReport' => $dataReport,
            'month' => $month,
            'monthName' => $monthName,
            'daysInMonth' => $daysInMonth,
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
