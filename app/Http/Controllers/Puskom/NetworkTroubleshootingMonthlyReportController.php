<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\NetworkTroubleshooting;
use App\Models\NetworkTroubleshootingMonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkTroubleshootingMonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $data = NetworkTroubleshooting::select(DB::raw('YEAR(date) as year, MONTH(date) as month, COUNT(*) as count'))
            ->where('status', 3)
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('puskom.report.network_troubleshooting.index', compact('data'));
    }


    public function showByIndex($year, $month)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = NetworkTroubleshooting::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('status', 3) 
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('puskom.report.network_troubleshooting.show_by_index', compact('data', 'year', 'month'));
    }


    public function show(NetworkTroubleshooting $id)
    {
        $networkTroubleshooting = $id;
        return view('puskom.report.network_troubleshooting.show', compact('networkTroubleshooting'));
    }


    public function verify(Request $request, $year, $month)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $monthlyReport = NetworkTroubleshootingMonthlyReport::updateOrCreate(
            ['year' => $year, 'month' => $monthResult],
            ['puskom_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }
}
