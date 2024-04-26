<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WebDevelopmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebDevelopmentController extends Controller
{
    public function index(Request $request)
    {
        $query = WebDevelopmentRequest::where('reported_by_id', Auth::id());
        
        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $webDevelopmentRequests = $query->paginate(10);
        $webDevelopmentRequests->appends(request()->query());
        return view('employee.web_development.index', compact('webDevelopmentRequests'));
    }

    public function show(WebDevelopmentRequest $id)
    {
        $webDevelopmentRequests = $id;
        return view('employee.web_development.show', compact('webDevelopmentRequests'));
    }

    public function verify(WebDevelopmentRequest $id, Request $request)
    {
        $webDevelopmentRequests = $id;
        $validated = $request->validate([
            'reporter_signature_approval' => 'required',
        ]);
        $webDevelopmentRequests->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature_approval']);
        $webDevelopmentRequests->reporter_signature_approval = $signaturePath;
        
        $webDevelopmentRequests->save();
        return redirect()->route('employee.webdevelopment.index')->with('success', 'Permohonan berhasil di verifikasi');
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
