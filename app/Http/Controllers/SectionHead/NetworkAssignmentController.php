<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebAssignmentStoreRequest;
use App\Models\Division;
use App\Models\NetworkAssignment;
use App\Models\Programmer;
use App\Models\User;
use App\Models\WebAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NetworkAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NetworkAssignment::query();

        $this->applySearchFilters($query, $request);

        $query->orderBy('date', 'desc');

        $data = $query->paginate(10);
        $data->appends(request()->query());

        $divisions = Division::all();
        $engineers = User::where('role_id', 11)->get();
        
        return view('section_head.network_assignment.index', compact('data', 'divisions', 'engineers'));
    }


    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }
        if ($request->filled('search_engineer')) {
            $query->where('engineer_id', $request->search_engineer);
        }
        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
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
    public function verify(NetworkAssignment $id, Request $request)
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
