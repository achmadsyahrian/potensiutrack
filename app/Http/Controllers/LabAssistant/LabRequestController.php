<?php

namespace App\Http\Controllers\LabAssistant;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequestStoreRequest;
use App\Models\Lab;
use App\Models\LabRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LabRequest::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $labRequests = $query->paginate(10);
        $labRequests->appends(request()->query());

        $lab_assistants = User::where('role_id', 3)->get();
        $labs = Lab::all();
        $lecturers = User::where('role_id', 6)->get();

        return view('lab_assistant.labrequests.index', compact('labRequests', 'lab_assistants', 'labs', 'lecturers'));
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
    public function store(LabRequestStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $signaturePath = $this->saveSignature($validatedData['lab_assistant_signature']);
            $validatedData['lab_assistant_signature'] = $signaturePath;

            // Simpan data ke dalam basis data
            LabRequest::create($validatedData);
            
            return redirect()->route('labassistant.labrequests.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(LabRequest $labRequest)
    {
        return view('lab_assistant.labrequests.show', compact('labRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabRequest $labRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabRequest $labRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabRequest $labRequest)
    {
        try {
            $labRequest->delete();
            if ($labRequest->lab_assistant_signature) {
                Storage::disk('public')->delete($labRequest->lab_assistant_signature);
            }
            return redirect()->route('labassistant.labrequests.index')->with('success', 'Permohonan berhasil dihapus!');
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
        if ($request->filled('search_lab')) {
            $query->where('lab_id', $request->search_lab);
        }

        if ($request->filled('search_scheduled_date')) {
            $query->whereDate('scheduled_date', $request->search_scheduled_date);
        }

        if ($request->filled('search_lecturer')) {
            $query->where('lecturer_id', $request->search_lecturer);
        }

        if ($request->filled('search_class')) {
            $query->where('class', 'like', '%' . $request->search_class . '%');
        }        
    }
}
