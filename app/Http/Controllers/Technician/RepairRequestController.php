<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepairRequestStoreRequest;
use App\Models\Division;
use App\Models\ItemInventory;
use App\Models\RepairRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RepairRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RepairRequest::query();

        $this->applySearchFilter($request, $query);

        $employees = User::where('role_id', 5)->get();
        $technicians = User::where('role_id', 4)->get();
        $divisions = Division::all();
        $itemInventories = ItemInventory::all();
        
        $repairRequests = $query->paginate(10);

        $repairRequests->appends(['search' => $request->search]);
        
        return view('technician.repair_request.index', compact('repairRequests', 'employees', 'technicians', 'divisions', 'itemInventories'));
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
    public function store(RepairRequestStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            RepairRequest::create($validatedData);
        
            return redirect()->route('technician.repairrequests.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairRequest $repairRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairRequest $repairRequest)
    {
        $employees = User::where('role_id', 5)->get();
        $technicians = User::where('role_id', 4)->get();
        $divisions = Division::all();
        $itemInventories = ItemInventory::all();
        return view('technician.repair_request.edit', compact('repairRequest', 'employees', 'technicians', 'divisions', 'itemInventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RepairRequestStoreRequest $request, RepairRequest $repairRequest)
    {
        try {
            $validatedData = $request->validated();

            if ($request->filled('return_date')) {
                $validatedData['status'] = 2;
            }
            $repairRequest->update($validatedData);
        
            return redirect()->route('technician.repairrequests.index')->with('success', 'Permohonan berhasil diperbarui!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairRequest $repairRequest)
    {
        try {
            $repairRequest->delete();
            
            return redirect()->route('technician.repairrequests.index')->with('success', 'Permohonan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Permohonan tidak dapat dihapus.');
        }
    }


    private function applySearchFilter(Request $request, $query)
    {
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        if ($request->filled('search_inventory_code')) {
            $query->where('inventory_code', 'like', '%' . $request->search_inventory_code . '%');
        }

        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
        }

        if ($request->filled('search_employee')) {
            $query->where('requested_by', $request->search_employee);
        }

        if ($request->filled('search_technician')) {
            $query->where('technician_id', $request->search_technician);
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }
    }
}
