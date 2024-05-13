<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebDevelopmentStoreRequest;
use App\Models\Division;
use App\Models\User;
use App\Models\WebDevelopmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebDevelopmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WebDevelopmentRequest::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $webDevelopments = $query->paginate(10);
        $webDevelopments->appends(request()->query());

        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();

        return view('puskom.web_development.index', compact('webDevelopments', 'employees', 'divisions'));
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
    public function store(WebDevelopmentStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $wr1SignaturePath = $this->saveSignature($validatedData['wakil_rektor1_signature']);
            $reporterSignaturePath = $this->saveSignature($validatedData['reporter_signature']);
            
            $validatedData['wakil_rektor1_signature'] = $wr1SignaturePath;
            $validatedData['reporter_signature'] = $reporterSignaturePath;
    
            WebDevelopmentRequest::create($validatedData);
            
            return redirect()->route('puskom.webdevelopment.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WebDevelopmentRequest $webDevelopment)
    {
        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();
        return view('puskom.web_development.show', compact('webDevelopment', 'employees', 'divisions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebDevelopmentRequest $webDevelopment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebDevelopmentRequest $webDevelopment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebDevelopmentRequest $web_development)
    {
        try {
            
            $web_development->delete();
            if ($web_development->wakil_rektor1_signature) {
                Storage::disk('public')->delete($web_development->wakil_rektor1_signature);
            }
            if ($web_development->reporter_signature_approval) {
                Storage::disk('public')->delete($web_development->reporter_signature_approval);
            }
            if ($web_development->reporter_signature) {
                Storage::disk('public')->delete($web_development->reporter_signature);
            }
            return redirect()->route('puskom.webdevelopment.index')->with('success', 'Permohonan berhasil dihapus!');
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
    public function markAsComplete(WebDevelopmentRequest $id, Request $request)
    {
        $validated = $request->validate([
            'finish_date' => 'required',
        ]);

        $webDevelopmentRequest = $id;
        $webDevelopmentRequest->status = 2;
        $webDevelopmentRequest->finish_date = $validated['finish_date'];
        $webDevelopmentRequest->save();
        return redirect()->route('puskom.webdevelopment.index')->with('success', 'Permohonan berhasil di perbarui');
    }
}
