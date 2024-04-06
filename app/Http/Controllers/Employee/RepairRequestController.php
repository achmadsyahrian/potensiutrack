<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairRequestController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $repairRequests = RepairRequest::where('requested_by', $logUserId)->paginate(10);

        return view('employee.repair_request.index', compact('repairRequests'));
    }

    public function show(RepairRequest $id)
    {
        $repairRequest = $id;
        return view('employee.repair_request.show', compact('repairRequest'));
    }

    public function verify(RepairRequest $id)
    {
        $repairRequest = $id;
        $repairRequest->status = 3;
        $repairRequest->save();
        return redirect()->route('employee.repairrequests.index')->with('success', 'Permohonan berhasil di verifikasi');
    }
}
