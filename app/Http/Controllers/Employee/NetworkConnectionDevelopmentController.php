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
        $query = NetworkConnectionDevelopment::where('reported_by_id', Auth::id());

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $networkDevelopment = $query->paginate(10);
        $networkDevelopment->appends(request()->query());

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
            'reporter_signature_approval' => 'required',
        ]);
        $networkDevelopment->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature_approval']);
        $networkDevelopment->reporter_signature_approval = $signaturePath;
        
        $networkDevelopment->save();
        return redirect()->route('employee.networkdev.index')->with('success', 'Permohonan berhasil di verifikasi');
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
