<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\NetworkAssignmentStoreRequest;
use App\Models\Division;
use App\Models\NetworkAssignment;
use App\Models\User;
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

        $engineers = User::where('role_id', 11)->get();
        $divisions = Division::all();
        
        return view('puskom.network_assignment.index', compact('data', 'engineers', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NetworkAssignmentStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
        
            NetworkAssignment::create($validatedData);
            
            return redirect()->route('puskom.networkassignment.index')->with('success', 'Penugasan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NetworkAssignment $networkAssignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NetworkAssignment $networkAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NetworkAssignment $networkAssignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkAssignment $networkAssignment)
    {
        try {
            
            $networkAssignment->delete();
            if ($networkAssignment->kabag_signature) {
                Storage::disk('public')->delete($networkAssignment->kabag_signature);
            }
            if ($networkAssignment->engineer_signature) {
                Storage::disk('public')->delete($networkAssignment->engineer_signature);
            }
            return redirect()->route('puskom.networkassignment.index')->with('success', 'Penugasan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Penugasan tidak dapat dihapus.');
        }
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

    public function markAsComplete(NetworkAssignment $id)
    {
        $networkAssignment = $id;
        $networkAssignment->finish_date = now();
        $networkAssignment->save();
        return redirect()->route('puskom.networkassignment.index')->with('success', 'Penugasan berhasil diselesaikan!');
    }
}
