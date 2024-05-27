<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\AppChekingReport;
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

}
