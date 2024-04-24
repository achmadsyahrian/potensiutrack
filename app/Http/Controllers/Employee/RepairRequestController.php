<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\ItemInventory;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairRequestController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $query = RepairRequest::where('requested_by', $logUserId);

        $this->applySearchFilter($request, $query);

        $repairRequests = $query->paginate(10);

        $divisions = Division::all();
        $itemInventories = ItemInventory::all();
        
        return view('employee.repair_request.index', compact('repairRequests', 'divisions', 'itemInventories'));
    }


    public function show(RepairRequest $id)
    {
        $repairRequest = $id;
        return view('employee.repair_request.show', compact('repairRequest'));
    }

    public function verify(RepairRequest $id, Request $request)
    {
        $repairRequest = $id;
        $validated = $request->validate([
            'employee_signature' => 'required',
        ]);
        $repairRequest->status = 3;
        $signaturePath = $this->saveSignature($validated['employee_signature']);
        $repairRequest->employee_signature = $signaturePath;
        $repairRequest->save();
        return redirect()->route('employee.repairrequests.index')->with('success', 'Permohonan berhasil di verifikasi');
    }


    // Search
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
