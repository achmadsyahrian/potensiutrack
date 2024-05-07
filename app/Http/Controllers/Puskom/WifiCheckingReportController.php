<?php

namespace App\Http\Controllers\Puskom;

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
            ->orderBy('building_id', 'asc')
            ->paginate(10);

        return view('puskom.report.wifi_checking.index', compact('data'));
    }



    public function showByIndex($building)
    {
        $data = WifiChecking::where('building_id', $building)
            ->orderBy('date', 'desc')
            ->paginate(10);

        $buildingName = Building::find($building)->name;
        return view('puskom.report.wifi_checking.show_by_index', compact('data', 'buildingName'));
    }



    public function show(WifiChecking $id)
    {
        $wifiChecking = $id;
        return view('puskom.report.wifi_checking.show', compact('wifiChecking'));
    }


    public function verify(Request $request, WifiChecking $id)
    {
        $validated = $request->validate([
            'puskom_signature' => 'required',
        ]);

        $kabagSignature = $this->saveSignature($validated['puskom_signature']);

        $id->puskom_signature = $kabagSignature;
        $id->save();

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
