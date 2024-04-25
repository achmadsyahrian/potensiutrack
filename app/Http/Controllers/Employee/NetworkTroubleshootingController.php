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
        $query = NetworkTroubleshooting::where('reported_by_id', Auth::id());

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $networkTroubleshootings = $query->paginate(10);
        $networkTroubleshootings->appends(request()->query());

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

    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        if ($request->filled('search_finish_date')) {
            $query->whereDate('finish_date', $request->search_finish_date);
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

    }

}
