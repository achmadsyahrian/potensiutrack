<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WebApp;
use App\Models\WebDevelopmentRequest;
use App\Models\WebMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $query = WebMaintenance::where('reported_by_id', Auth::id());

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $webMaintenances = $query->paginate(10);
        $webMaintenances->appends(request()->query());

        $webApps = WebApp::all();
        
        return view('employee.web_maintenance.index', compact('webMaintenances', 'webApps'));
    }

    public function show(WebMaintenance $id)
    {
        $webMaintenances = $id;
        return view('employee.web_maintenance.show', compact('webMaintenances'));
    }

    public function verify(WebMaintenance $id, Request $request)
    {
        $webMaintenances = $id;
        $validated = $request->validate([
            'reporter_signature_approval' => 'required',
        ]);
        $webMaintenances->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature_approval']);
        $webMaintenances->reporter_signature_approval = $signaturePath;
        
        $webMaintenances->save();
        return redirect()->route('employee.webmaintenance.index')->with('success', 'Permohonan berhasil di verifikasi');
    }


    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
        }

        if ($request->filled('search_app')) {
            $query->where('web_app_id', $request->search_app);
        }


        if ($request->filled('search_finish_date')) {
            $query->whereDate('finish_date', $request->search_finish_date);
        }

        if ($request->filled('search_reporter')) {
            $query->where('reported_by_id', $request->search_reporter);
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

    }


}
