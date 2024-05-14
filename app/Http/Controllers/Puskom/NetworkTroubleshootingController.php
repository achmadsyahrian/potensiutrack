<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\NetworkTroubleshootingStoreRequest;
use App\Models\Division;
use App\Models\NetworkTroubleshooting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NetworkTroubleshootingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NetworkTroubleshooting::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $networkTroubleshooting = $query->paginate(10);
        $networkTroubleshooting->appends(request()->query());

        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();

        return view('puskom.network_troubleshooting.index', compact('networkTroubleshooting', 'employees', 'divisions'));
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
    public function store(NetworkTroubleshootingStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            // $puskomSignaturePath = $this->saveSignature($validatedData['puskom_signature']);
            $reporterSignaturePath = $this->saveSignature($validatedData['reporter_signature']);
            
            // $validatedData['puskom_signature'] = $puskomSignaturePath;
            $validatedData['reporter_signature'] = $reporterSignaturePath;
    
            NetworkTroubleshooting::create($validatedData);
            
            return redirect()->route('puskom.networktroubleshooting.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NetworkTroubleshooting $networkTroubleshooting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NetworkTroubleshooting $networkTroubleshooting)
    {
        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();
        return view('puskom.network_troubleshooting.edit', compact('networkTroubleshooting', 'employees', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NetworkTroubleshooting $networkTroubleshooting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkTroubleshooting $networkTroubleshooting)
    {
        try {
            $networkTroubleshooting->delete();
            // if ($networkTroubleshooting->puskom_signature) {
            //     Storage::disk('public')->delete($networkTroubleshooting->puskom_signature);
            // }
            if ($networkTroubleshooting->reporter_signature_approval) {
                Storage::disk('public')->delete($networkTroubleshooting->reporter_signature_approval);
            }
            if ($networkTroubleshooting->reporter_signature) {
                Storage::disk('public')->delete($networkTroubleshooting->reporter_signature);
            }
            return redirect()->route('puskom.networktroubleshooting.index')->with('success', 'Permohonan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Permohonan tidak dapat dihapus.');
        }
    }

    // Search
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

    // Verif
    public function markAsComplete(NetworkTroubleshooting $id, Request $request)
    {
        $validated = $request->validate([
            'finish_date' => 'required',
        ]);

        $networkTroubleshooting = $id;
        $networkTroubleshooting->status = 2;
        $networkTroubleshooting->finish_date = $validated['finish_date'];
        $networkTroubleshooting->save();
        return redirect()->route('puskom.networktroubleshooting.index')->with('success', 'Permohonan berhasil di perbarui');
    }
}
