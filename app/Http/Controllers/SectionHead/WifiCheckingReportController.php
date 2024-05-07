<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WifiCheckingReportController extends Controller
{
    public function index(Request $request)
    {
        $data = WifiChecking::select(DB::raw('building_id, COUNT(*) as count'))
            ->groupBy('building_id')
            ->orderBy('building_id', 'asc') // Sesuaikan urutan pengurutan sesuai kebutuhan
            ->paginate(10);

        return view('section_head.wifi_checking_report.index', compact('data'));
    }



    public function showByIndex($building)
    {
        $data = WifiChecking::where('building_id', $building)
            ->orderBy('date', 'desc')
            ->paginate(10);

        $buildingName = Building::find($building)->name;
        return view('section_head.wifi_checking_report.show_by_index', compact('data', 'buildingName'));
    }



    public function show(WifiChecking $id)
    {
        $wifiChecking = $id;
        return view('section_head.wifi_checking_report.show', compact('wifiChecking'));
    }


    public function verify(Request $request, WifiChecking $id)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);

        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $id->kabag_signature = $kabagSignature;
        $id->save();

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
