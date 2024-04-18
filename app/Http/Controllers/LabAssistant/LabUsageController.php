<?php

namespace App\Http\Controllers\LabAssistant;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabUsage;
use App\Models\User;
use Illuminate\Http\Request;

class LabUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LabUsage::query();

        $this->applySearchFilters($query, $request);

        $labUsages = $query->paginate(10);
        $labUsages->appends(request()->query());

        $lab_assistants = User::where('role_id', 3)->get();
        $labs = Lab::all();
        $lecturers = User::where('role_id', 6)->get();

        return view('lab_assistant.labusages.index', compact('labUsages', 'lab_assistants', 'labs', 'lecturers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LabUsage $labUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabUsage $labUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabUsage $labUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabUsage $labUsage)
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
        if ($request->filled('search_lab')) {
            $query->where('lab_id', $request->search_lab);
        }

        if ($request->filled('search_lecturer')) {
            $query->where('lecturer_id', $request->search_lecturer);
        }

        if ($request->filled('search_class')) {
            $query->where('class', 'like', '%' . $request->search_class . '%');
        }        
    }
}
