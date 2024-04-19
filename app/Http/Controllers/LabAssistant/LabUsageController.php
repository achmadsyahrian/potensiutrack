<?php

namespace App\Http\Controllers\LabAssistant;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabUsageStoreRequest;
use App\Models\Lab;
use App\Models\LabUsage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LabUsage::query();

        $this->applySearchFilters($query, $request);

        $labUsages = $query->paginate(10);
        $labUsages->appends(request()->query());

        $lab_assistants = User::where('role_id', 3)->get();
        $labs = Lab::all();
        $lecturers = User::where('role_id', 6)->get();

        return view('lab_assistant.labusages.index', compact('labUsages', 'lab_assistants', 'labs', 'lecturers'));
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
    public function store(LabUsageStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $base64Signature = $validatedData['lab_assistant_signature'];
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Signature));
            $fileName = 'paraf_' . uniqid() . '.png';
            $directory = storage_path('app/public/signature');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            file_put_contents($directory . '/' . $fileName, $imageData);

            $validatedData['lab_assistant_signature'] = 'signature/' . $fileName;
            LabUsage::create($validatedData);
            
            return redirect()->route('labassistant.labusages.index')->with('success', 'Penggunaan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LabUsage $labUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabUsage $labUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabUsage $labUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabUsage $labUsage)
    {
        try {
            $labUsage->delete();
            if ($labUsage->lab_assistant_signature) {
                Storage::disk('public')->delete($labUsage->lab_assistant_signature);
            }
            return redirect()->route('labassistant.labusages.index')->with('success', 'Penggunaan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Penggunaan tidak dapat dihapus.');
        }
    }

    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        if ($request->filled('search_time')) {
            $query->where('time', $request->search_time);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_lab')) {
            $query->where('lab_id', $request->search_lab);
        }

        if ($request->filled('search_lecturer')) {
            $query->where('lecturer_id', $request->search_lecturer);
        }

        if ($request->filled('search_class')) {
            $query->where('class', 'like', '%' . $request->search_class . '%');
        }        
    }
}
