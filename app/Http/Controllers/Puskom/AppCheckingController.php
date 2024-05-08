<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Models\AppChecking;
use App\Models\WebApp;
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

        $query->orderBy('month', 'desc');
        $apps = WebApp::all();
        
        $data = $query->paginate(10);
        $data->appends(['search' => $request->search]);
        
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

        $this->validateUniqueEntry($validated);
        $this->createAppChecking($validated);

        return redirect()->back()->with('success', 'Laporan berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(AppChecking $appChecking)
    {
        $webApps = WebApp::all();
        return view('puskom.app_checking.show', compact('appChecking', 'webApps'));
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
    public function update(Request $request, AppChecking $appChecking)
    {
        $input = $request->except('_token', '_method');
        $newResults = [];

        foreach ($input as $key => $value) {
            if ($value === 'on') {

                $parts = explode('_', $key);
                $appId = $parts[1];
                $date = $parts[2];
                $time = 'jam_' . substr($parts[3], 0, 2);
                if (!isset($newResults['app_' . $appId])) {
                    $newResults['app_' . $appId] = [];
                }
                if (!isset($newResults['app_' . $appId][$date])) {
                    $newResults['app_' . $appId][$date] = [];
                }
                $newResults['app_' . $appId][$date][$time] = 1;
            }
        }

        $appChecking->update(['result' => json_encode($newResults)]);

        return redirect()->route('puskom.appchecking.index')->with('success', 'Laporan berhasil disimpan!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppChecking $appChecking)
    {
        $appChecking->delete();

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

    private function validateUniqueEntry($validated)
    {
        $existingEntry = AppChecking::where('month', $validated['month'])
                        ->where('year', $validated['year'])
                        ->exists();

        if ($existingEntry) {
            throw ValidationException::withMessages([
                'month' => ['Laporan untuk bulan dan tahun yang sama sudah ada!'],
            ]);
        }
    }


    private function createAppChecking($validated)
    {
        $appChecking = new AppChecking();
        $appChecking->month = $validated['month'];
        $appChecking->year = $validated['year'];
        $appChecking->save();
    }

    
}
