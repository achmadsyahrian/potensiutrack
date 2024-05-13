<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebAssignmentStoreRequest;
use App\Models\Programmer;
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
        $query->orderBy('date', 'desc');

        $data = $query->paginate(10);
        $data->appends(request()->query());

        $programmers = Programmer::all();
        
        return view('puskom.web_assignment.index', compact('data', 'programmers'));
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
    public function store(WebAssignmentStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
        
            WebAssignment::create($validatedData);
            
            return redirect()->route('puskom.webassignment.index')->with('success', 'Penugasan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WebAssignment $webAssignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebAssignment $webAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebAssignment $webAssignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebAssignment $webAssignment)
    {
        try {
            
            $webAssignment->delete();
            if ($webAssignment->kabag_signature) {
                Storage::disk('public')->delete($webAssignment->kabag_signature);
            }
            if ($webAssignment->programmer_signature) {
                Storage::disk('public')->delete($webAssignment->programmer_signature);
            }
            return redirect()->route('puskom.webassignment.index')->with('success', 'Penugasan berhasil dihapus!');
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
    public function markAsComplete(WebAssignment $id)
    {
        $webDevelopmentRequest = $id;
        $webDevelopmentRequest->finish_date = now();
        $webDevelopmentRequest->save();
        return redirect()->route('puskom.webassignment.index')->with('success', 'Penugasan berhasil diselesaikan!');
    }

}
