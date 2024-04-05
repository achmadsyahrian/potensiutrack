<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lab::query();

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $labs = $query->paginate(10);

        // Menambahkan parameter pencarian ke URL halaman berikutnya
        $labs->appends(['search' => $request->search]);

        return view('administrator.labs.index', compact('labs'));
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
            'name' => [
                'required',
                'min:3',
                Rule::unique('labs')->ignore($request->id),
            ],    
        ]);

        Lab::create($validatedData);
    
        return redirect()->route('labs.index')->with('success', 'Lab berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        return view('administrator.labs.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lab $lab)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',  
        ]);

        $lab->update($validatedData);
    
        return redirect()->route('labs.index')->with('success', 'Lab berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        try {
            $lab->computers()->delete();
        
            $lab->delete();
            
            return redirect()->route('labs.index')->with('success', 'Lab berhasil dihapus!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Lab tidak dapat dihapus.');
        }
    }

}
