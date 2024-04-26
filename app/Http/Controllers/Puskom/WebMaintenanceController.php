<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebMaintenanceStoreRequest;
use App\Models\Division;
use App\Models\User;
use App\Models\WebApp;
use App\Models\WebMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WebMaintenance::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $webMaintenances = $query->paginate(10);
        $webMaintenances->appends(request()->query());

        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();
        $webApps = WebApp::all();

        return view('puskom.web_maintenance.index', compact('webMaintenances', 'employees', 'divisions', 'webApps'));
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
    public function store(WebMaintenanceStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $signaturePath = $this->saveSignature($validatedData['puskom_signature']);
            
            $validatedData['puskom_signature'] = $signaturePath;
    
            WebMaintenance::create($validatedData);
            
            return redirect()->route('puskom.webmaintenance.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WebMaintenance $web_maintenance)
    {
        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();
        return view('puskom.web_maintenance.show', compact('web_maintenance', 'employees', 'divisions'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebMaintenance $webMaintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebMaintenance $webMaintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebMaintenance $web_maintenance)
    {
        try {
            $web_maintenance->delete();
            if ($web_maintenance->puskom_signature) {
                Storage::disk('public')->delete($web_maintenance->puskom_signature);
            }
            if ($web_maintenance->reporter_signature) {
                Storage::disk('public')->delete($web_maintenance->reporter_signature);
            }
            return redirect()->route('puskom.webmaintenance.index')->with('success', 'Permohonan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Permohonan tidak dapat dihapus.');
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

    public function markAsComplete(WebMaintenance $id, Request $request)
    {
        $validated = $request->validate([
            'finish_date' => 'required',
            'handling' => 'nullable',
        ]);

        $webMaintenance = $id;
        $webMaintenance->status = 2;
        $webMaintenance->finish_date = $validated['finish_date'];
        $webMaintenance->handling = $validated['handling'];
        $webMaintenance->save();
        return redirect()->route('puskom.webmaintenance.index')->with('success', 'Permohonan berhasil di perbarui');
    }
}
