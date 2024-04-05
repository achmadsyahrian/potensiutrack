<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('administrator.roles.index', compact('roles'));
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
                'name' => 'required|unique:roles|max:255',
                'description' => 'nullable',
            ]);

            Role::create($validatedData);
            
            return redirect()->route('roles.index')->with('success', 'Level berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('administrator.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
                'description' => 'nullable',
            ]);
    
            $role->update($validatedData);
        
            return redirect()->route('roles.index')->with('success', 'Level berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $users = $role->users;

        foreach ($users as $user) {
            $user->delete();
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Peran dan pengguna terkait berhasil dihapus!');
    }


}
