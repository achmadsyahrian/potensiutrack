<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WifiCheckingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $query = WifiChecking::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $wifiCheckings = $query->paginate(10);
        $wifiCheckings->appends(request()->query());

        $buildings = Building::all();

        return view('puskom.wifi_checking.index', compact('wifiCheckings', 'buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buildings = Building::all();
        return view('puskom.wifi_checking.create', compact('buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'building_id' => 'required|exists:buildings,id',
        ]);

        $requestData = $request->all();
        if ($validator->fails()) { return redirect()->back()->withErrors($validator)->withInput(); }
        if ($this->isDuplicateData($request->date, $request->building_id)) {
            Session::flash('error', 'Data untuk lokasi yang sama pada tanggal yang sama sudah tersedia.');
            return redirect()->back()->withInput();
        }
        $floorData = $this->prepareFloorData($requestData);
        
        // dd($floorData);
        
        WifiChecking::create([
            'building_id' => $requestData['building_id'],
            'date' => $requestData['date'],
            'floor_1' => isset($floorData['floor1']) ? json_encode($floorData['floor1']) : null,
            'floor_2' => isset($floorData['floor2']) ? json_encode($floorData['floor2']) : null,
            'floor_3' => isset($floorData['floor3']) ? json_encode($floorData['floor3']) : null,
            'floor_4' => isset($floorData['floor4']) ? json_encode($floorData['floor4']) : null
        ]);
        
        return redirect()->route('puskom.wifichecking.index')->with('success', 'Data Laporan berhasil disimpan');
    }



    /**
     * Display the specified resource.
     */
    public function show(WifiChecking $wifiChecking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WifiChecking $wifiChecking)
    {
        $buildings = Building::all();
        return view('puskom.wifi_checking.edit', compact('wifiChecking', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WifiChecking $wifiChecking)
    {
        $requestData = $request->all();
        $floorData = $this->prepareFloorData($requestData);

        $wifiChecking->update([
            'floor_1' => isset($floorData['floor1']) ? json_encode($floorData['floor1']) : null,
            'floor_2' => isset($floorData['floor2']) ? json_encode($floorData['floor2']) : null,
            'floor_3' => isset($floorData['floor3']) ? json_encode($floorData['floor3']) : null,
            'floor_4' => isset($floorData['floor4']) ? json_encode($floorData['floor4']) : null,
        ]);
        
        return redirect()->route('puskom.wifichecking.index')->with('success', 'Data Laporan berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WifiChecking $wifiChecking)
    {
        try {
            $wifiChecking->delete();
            return redirect()->route('puskom.wifichecking.index')->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Laporan tidak dapat dihapus.');
        }
    }

    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
        }

        if ($request->filled('search_app')) {
            $query->where('web_app_id', $request->search_app);
        }

        if ($request->filled('search_finish_date')) {
            $query->whereDate('finish_date', $request->search_finish_date);
        }

        if ($request->filled('search_reporter')) {
            $query->where('reported_by_id', $request->search_reporter);
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

    }


    private function prepareFloorData($requestData)
    {
        $floorData = [];

        for ($i = 1; $i <= 4; $i++) {
            $floorKey = 'floor' . $i;
            $floorAttributes = [
                'accesspoint', 'device_name', 'condition', 'description'
            ];

            // Periksa apakah setiap atribut lantai tidak kosong
            $floorIsEmpty = true;
            foreach ($floorAttributes as $attribute) {
                if (!empty($requestData[$floorKey . '_' . $attribute])) {
                    $floorIsEmpty = false;
                    break;
                }
            }

            // Jika lantai tidak kosong, tambahkan ke $floorData
            if (!$floorIsEmpty) {
                $floorData[$floorKey] = [
                    'accesspoint' => $requestData[$floorKey . '_accesspoint'],
                    'device_name' => $requestData[$floorKey . '_device_name'],
                    'condition' => $requestData[$floorKey . '_condition'],
                    'description' => $requestData[$floorKey . '_description']
                ];
            }
        }

        return $floorData;
    }


    private function isDuplicateData($date, $buildingId)
    {
        return WifiChecking::where('date', $date)->where('building_id', $buildingId)->exists();
    }


}
