<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\AppChekingReport;
use App\Models\WebApp;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppCheckingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AppChecking::query();
        $this->applySearchFilter($request, $query);

        $query->groupBy('month', 'year');
        $query->selectRaw('MIN(id) as id, month, year');
        $query->orderBy('year', 'desc')->orderBy('month', 'desc');

        $data = $query->paginate(10);
        $data->appends(['search' => $request->search]);
        
        $apps = WebApp::all();
        return view('puskom.app_checking.index', compact('data', 'apps'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        
        $webApps = WebApp::all();
        
        foreach ($webApps as $webApp) {
            $this->validateUniqueEntry($validated['month'], $validated['year'], $webApp->id);
            $this->createAppChecking($validated['month'], $validated['year'], $webApp->id);
        }

        return redirect()->back()->with('success', 'Laporan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function showByMonthAndYear($year, $month)
    {
        $appChecking = AppChecking::where('year', $year)->where('month', $month)->get();

        return view('puskom.app_checking.show', compact('appChecking', 'month', 'year'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppChecking $appChecking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateByMonthAndYear(Request $request, $year, $month)
    {
        $input = $request->except('_token', '_method');
        $newResults = [];
        
        foreach ($input as $key => $value) {
            $parts = explode('_', $key);
            $appId = $parts[1];
            $day = $parts[3]; // Ambil day dari input key
            $time = 'jam_' . substr($parts[5], 0, 2);

            if ($value === 'on') {
                if (!isset($newResults[$appId])) {
                    $newResults[$appId] = [];
                }
                if (!isset($newResults[$appId][$day])) {
                    $newResults[$appId][$day] = [];
                }
                $newResults[$appId][$day][$time] = 1;
            } 
        }
        
        
        if (empty($newResults)) {
            $appCheckings = AppChecking::where('year', $year)
                ->where('month', $month)
                ->get();

            foreach ($appCheckings as $app) {
                $app->update(['result' => null]);
            }

        } else {
            foreach ($newResults as $appId => $days) {
                foreach ($days as $day => $times) {
                    $existingChecking = AppChecking::where('web_app_id', $appId)
                        ->where('year', $year)
                        ->where('month', $month)
                        ->first();

                    if ($existingChecking) {
                        $result = json_decode($existingChecking->result, true);

                        foreach ($times as $time => $value) {
                            $result[$day][$time] = $value;
                        }
                        $existingChecking->update(['result' => json_encode($days)]);
                    }
                }
            }
        }

        return redirect()->route('puskom.appchecking.index')->with('success', 'Laporan berhasil disimpan!');


        return redirect()->route('puskom.appchecking.index')->with('success', 'Laporan berhasil disimpan!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyByMonthAndYear($year, $month)
    {
        AppChecking::where('year', $year)->where('month', $month)->delete();
    
        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }

    private function applySearchFilter(Request $request, $query)
    {

        if ($request->filled('search_month')) {
            $query->where('month', $request->search_month);
        }

        if ($request->filled('search_year')) {
            $query->where('year', $request->search_year);
        }
    
    }

    private function validateUniqueEntry($month, $year, $webAppId)
    {
        $existingEntry = AppChecking::where('month', $month)
                        ->where('year', $year)
                        ->where('web_app_id', $webAppId) // Tambahkan kondisi untuk ID aplikasi web
                        ->exists();

        if ($existingEntry) {
            throw ValidationException::withMessages([
                'month' => ['Laporan untuk bulan, tahun, dan aplikasi yang sama sudah ada!'],
            ]);
        }
    }

    private function createAppChecking($month, $year, $webAppId)
    {
        $appChecking = new AppChecking();
        $appChecking->month = $month;
        $appChecking->year = $year;
        $appChecking->web_app_id = $webAppId;
        $appChecking->save();
    }

    
}
