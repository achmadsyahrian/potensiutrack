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
        $data = NetworkConnectionDevelopment::select(DB::raw('YEAR(date) as year, COUNT(*) as count'))
            ->where('status', 3) // Menambahkan kondisi status adalah 3
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('section_head.network_developments_report.index', compact('data'));
    }


    public function showByIndex($year)
    {
        $data = NetworkConnectionDevelopment::whereYear('date', $year)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('section_head.network_developments_report.show_by_index', compact('data', 'year'));
    }


    public function show(NetworkConnectionDevelopment $id)
    {   
        $networkTroubleshooting = $id;
        return view('section_head.network_developments_report.show', compact('networkTroubleshooting'));
    }


    public function verify(Request $request, $year)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = NetworkDevelopmentReport::updateOrCreate(
            ['year' => $year],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan tahunan telah diverifikasi.');
    }
}
