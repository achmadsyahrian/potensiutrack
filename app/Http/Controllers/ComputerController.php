<?php

namespace App\Http\Controllers;

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
        
        $query = Computer::query(); // Menggunakan model Computer

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $computers = $query->paginate(10); // Menggunakan paginate() pada model Computer
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
            'lab_id' => 'required',
        ]);

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

        $computer->update($validatedData);

        return redirect()->route('computers.index')->with('success', 'Komputer berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();
        return redirect()->route('computers.index')->with('success', 'Komputer berhasil dihapus!');
    }
}
