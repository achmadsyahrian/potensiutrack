<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use App\Models\WifiChecking;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function print(WifiChecking $id)
    {
        $data = $id;
        $floor1Data = json_decode($data->floor_1, true);
        $floor2Data = json_decode($data->floor_2, true);
        $floor3Data = $data->floor_3 ? json_decode($data->floor_3, true) : [];
        $floor4Data = $data->floor_4 ? json_decode($data->floor_4, true) : [];

        $html = view('puskom.report.wifi_checking.print', [
            'data' => $data,
            'pageCount' => 0,
            'floor1Data' => $floor1Data,
            'floor2Data' => $floor2Data,
            'floor3Data' => $floor3Data,
            'floor4Data' => $floor4Data,
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
                "Content-Disposition" => "inline; filename=FORM LAPORAN PENGECEKAN WIFI GEDUNG.pdf",
            ]
        );
    }

}
