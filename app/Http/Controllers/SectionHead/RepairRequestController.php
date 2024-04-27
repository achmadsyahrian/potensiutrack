<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairRequestController extends Controller
{
    public function index(Request $request)
    {
        $repairRequests = RepairRequest::where('status', 3)->paginate(10);

        return view('section_head.repair_request.index', compact('repairRequests'));
    }

    public function show(RepairRequest $id)
    {
        $repairRequest = $id;
        return view('section_head.repair_request.show', compact('repairRequest'));
    }

    public function verify(RepairRequest $id, Request $request)
    {
        $repairRequest = $id;
        $validated = $request->validate([
            'kabag_signature_approval' => 'required',
        ]);

        $repairRequest->status = 4;
        $signaturePath = $this->saveSignature($validated['kabag_signature_approval']);
        $repairRequest->employee_signature = $signaturePath;
        $repairRequest->save();
        return redirect()->route('sectionhead.repairrequests.index')->with('success', 'Permohonan berhasil di verifikasi');
    }

    public function reject(RepairRequest $id)
    {
        $repairRequest = $id;
        $repairRequest->status = 5;
        $repairRequest->save();
        return redirect()->route('sectionhead.repairrequests.index')->with('success', 'Permohonan berhasil di tolak');
    }
}
