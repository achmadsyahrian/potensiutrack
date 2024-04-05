<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Division::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $divisions = $query->paginate(10);

        $divisions->appends(['search' => $request->search]);

        return view('administrator.divisions.index', compact('divisions'));
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:divisions|max:255'
            ]);

            Division::create($validatedData);
            
            return redirect()->route('divisions.index')->with('success', 'Divisi berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        return view('administrator.divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:divisions,name,' . $division->id . '|max:255',
            ]);
    
            $division->update($validatedData);
        
            return redirect()->route('divisions.index')->with('success', 'Divisi berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        try {
            $division->delete();
            
            return redirect()->route('divisions.index')->with('success', 'Divisi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Divisi tidak dapat dihapus.');
        }
    }
}
