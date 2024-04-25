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
        $logUserId = Auth::id();
        $webDevelopmentRequests = WebDevelopmentRequest::where('reported_by_id', $logUserId)->paginate(10);

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
            'reporter_signature' => 'required',
        ]);
        $webDevelopmentRequests->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature']);
        $webDevelopmentRequests->reporter_signature = $signaturePath;
        
        $webDevelopmentRequests->save();
        return redirect()->route('employee.webdevelopment.index')->with('success', 'Permohonan berhasil di verifikasi');
    }

}
