<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\NetworkTroubleshooting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkTroubleshootingController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $networkTroubleshootings = NetworkTroubleshooting::where('reported_by_id', $logUserId)->paginate(10);

        return view('employee.network_troubleshooting.index', compact('networkTroubleshootings'));
    }

    public function show(NetworkTroubleshooting $id)
    {
        $networkTroubleshooting = $id;
        return view('employee.network_troubleshooting.show', compact('networkTroubleshooting'));
    }

    public function verify(NetworkTroubleshooting $id, Request $request)
    {
        $networkTroubleshooting = $id;
        $validated = $request->validate([
            'reporter_signature' => 'required',
        ]);
        $networkTroubleshooting->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature']);
        $networkTroubleshooting->reporter_signature = $signaturePath;
        
        $networkTroubleshooting->save();
        return redirect()->route('employee.networktroubleshooting.index')->with('success', 'Permohonan berhasil di verifikasi');
    }

}
