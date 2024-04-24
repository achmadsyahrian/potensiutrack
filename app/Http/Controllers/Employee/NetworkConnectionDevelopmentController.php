<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\NetworkConnectionDevelopment;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkConnectionDevelopmentController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $networkDevelopment = NetworkConnectionDevelopment::where('reported_by_id', $logUserId)->paginate(10);

        return view('employee.network_development.index', compact('networkDevelopment'));
    }

    public function show(NetworkConnectionDevelopment $id)
    {
        $networkDevelopment = $id;
        return view('employee.network_development.show', compact('networkDevelopment'));
    }

    public function verify(NetworkConnectionDevelopment $id, Request $request)
    {
        $networkDevelopment = $id;
        $validated = $request->validate([
            'reporter_signature' => 'required',
        ]);
        $networkDevelopment->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature']);
        $networkDevelopment->reporter_signature = $signaturePath;
        
        $networkDevelopment->save();
        return redirect()->route('employee.networkdev.index')->with('success', 'Permohonan berhasil di verifikasi');
    }
}
