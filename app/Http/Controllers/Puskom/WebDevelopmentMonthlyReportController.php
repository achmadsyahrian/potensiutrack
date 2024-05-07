<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\WebDevelopmentMonthlyReport;
use App\Models\WebDevelopmentRequest;
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
}
