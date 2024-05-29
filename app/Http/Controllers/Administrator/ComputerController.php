<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\Lab;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $labs = Lab::all();
        
        $query = Computer::query();

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        // Tambahkan pengurutan berdasarkan lab_id
        $query->orderBy('lab_id');

        $computers = $query->paginate(10); 

        $computers->appends(['search' => $request->search]);

        return view('administrator.computers.index', compact('labs', 'computers'));
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5',
            'lab_id' => 'required|exists:labs,id',
        ]);

        // Perbaikan di sini: panggil fungsi tanpa parameter id
        $duplicateResponse = $this->checkAndRespondIfDuplicate($validatedData['name'], $validatedData['lab_id']);
        
        if ($duplicateResponse) {
            return $duplicateResponse;
        }

        Computer::create($validatedData);
    
        return redirect()->route('computers.index')->with('success', 'Komputer berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Computer $computer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer)
    {
        $labs = Lab::all();
        return view('administrator.computers.edit', compact('computer', 'labs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Computer $computer)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5',
            'lab_id' => 'required|exists:labs,id',
        ]);

        $duplicateResponse = $this->checkAndRespondIfDuplicate($validatedData['name'], $validatedData['lab_id'], $computer->id);
        if ($duplicateResponse) {
            return $duplicateResponse;
        }

        $computer->update($validatedData);

        return redirect()->route('computers.index')->with('success', 'Komputer berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();
        return redirect()->route('computers.index')->with('success', 'Komputer berhasil dihapus!');
    }

    private function checkAndRespondIfDuplicate($name, $lab_id, $excludeId = null)
    {
        $query = Computer::where('name', $name)->where('lab_id', $lab_id);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        if ($query->exists()) {
            return redirect()->back()->withInput()->withErrors([
                'name' => 'Komputer dengan nama dan lab yang sama sudah ada.',
            ]);
        }

        return null;
    }
    
}
