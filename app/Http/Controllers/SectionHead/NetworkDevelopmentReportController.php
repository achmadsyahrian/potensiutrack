<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\NetworkConnectionDevelopment;
use App\Models\NetworkDevelopmentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkDevelopmentReportController extends Controller
{
    public function index(Request $request)
    {
        $data = NetworkConnectionDevelopment::select(DB::raw('YEAR(date) as year, MONTH(date) as month, COUNT(*) as count'))
            ->where('status', 3) // Menambahkan kondisi status adalah 3
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('section_head.network_developments_report.index', compact('data'));
    }


    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = NetworkConnectionDevelopment::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.network_developments_report.show_by_index', compact('data', 'year', 'month'));
    }


    public function show(NetworkConnectionDevelopment $id)
    {   
        $networkTroubleshooting = $id;
        return view('section_head.network_developments_report.show', compact('networkTroubleshooting'));
    }


    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = NetworkDevelopmentReport::updateOrCreate(
            ['year' => $year, 'month' => $monthResult],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
