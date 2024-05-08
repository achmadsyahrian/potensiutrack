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
            'web_app_id' => 'required',
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
        return view('puskom.app_checking.show', compact('appChecking'));
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

        $results = [];

        foreach ($input as $key => $value) {
            list($date, $time) = explode('_', $key);
            if ($value === 'on') {
                $time = 'jam_' . substr($time, 0, 2);
                $results[$date][$time] = 1;
            }
        }
        $appChecking->result = json_encode($results);
        $appChecking->save();

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
        if ($request->filled('search_apps')) {
            $query->where('web_app_id', $request->search_apps);
        }

        if ($request->filled('search_month')) {
            $query->where('month', $request->search_month);
        }

        if ($request->filled('search_year')) {
            $query->where('year', $request->search_year);
        }
    
    }

    private function validateUniqueEntry($validated)
    {
        $existingEntry = AppChecking::where('web_app_id', $validated['web_app_id'])
                        ->where('month', $validated['month'])
                        ->where('year', $validated['year'])
                        ->exists();

        if ($existingEntry) {
            throw ValidationException::withMessages([
                'web_app_id' => ['Aplikasi ini sudah memiliki laporan pada bulan dan tahun yang sama!'],
            ]);
        }
    }

    private function createAppChecking($validated)
    {
        $appChecking = new AppChecking();
        $appChecking->web_app_id = $validated['web_app_id'];
        $appChecking->month = $validated['month'];
        $appChecking->year = $validated['year'];
        $appChecking->save();
    }

    
}
