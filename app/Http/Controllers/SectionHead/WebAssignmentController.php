<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebAssignmentStoreRequest;
use App\Models\Programmer;
use App\Models\User;
use App\Models\WebAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WebAssignment::query();

        $this->applySearchFilters($query, $request);

        $query->whereNotNull('finish_date');

        $query->orderBy('date', 'desc');

        $data = $query->paginate(10);
        $data->appends(request()->query());

        $programmers = User::where('role_id', 10)->get();

        return view('section_head.web_assignment.index', compact('data', 'programmers'));
    }


    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_application')) {
            $query->where('application', 'like', '%' . $request->search_application . '%');
        }        

        if ($request->filled('search_programmer')) {
            $query->where('programmer_id', $request->search_programmer);
        }

        if ($request->filled('search_finish_date')) {
            $query->whereDate('finish_date', $request->search_finish_date);
        }

        if ($request->filled('search_status')) {
            if ($request->search_status == 1) {
                $query->whereNull('finish_date');
            } elseif ($request->search_status == 2) {
                $query->whereNotNull('finish_date');
            }
        }
    }

    // Verif
    public function verify(WebAssignment $id, Request $request)
    {
        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $signatureResult = $this->saveSignature($validated['kabag_signature']);

        $id->kabag_signature = $signatureResult;
        $id->save();
        
        return redirect()->back()->with('success', 'Data telah diverifikasi.');
    }

}
