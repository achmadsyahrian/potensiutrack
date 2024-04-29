<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\WifiChecking;
use Illuminate\Http\Request;

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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WifiChecking $wifiChecking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WifiChecking $wifiChecking)
    {
        //
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
}
