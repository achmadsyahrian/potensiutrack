<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WebAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webApps = WebApp::paginate(10);
        return view('administrator.web_apps.index', compact('webApps'));
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
                'name' => 'required|unique:web_apps|max:255',
                'description' => 'nullable',
            ]);

            WebApp::create($validatedData);
            
            return redirect()->route('webapps.index')->with('success', 'Web Aplikasi berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WebApp $webApp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebApp $web_application)
    {
        return view('administrator.web_apps.edit', compact('web_application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebApp $web_application)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:web_apps,name,' . $web_application->id . '|max:255',
                'description' => 'nullable',
            ]);
    
            $web_application->update($validatedData);
        
            return redirect()->route('webapps.index')->with('success', 'Web Aplikasi berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebApp $web_application)
    {
        $web_application->delete();
        return redirect()->route('webapps.index')->with('success', 'Web Aplikasi terkait berhasil dihapus!');
    }
}
