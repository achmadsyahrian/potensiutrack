<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\ItemInventory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ItemInventory::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('code', 'like', "%$search%");
            });
        }

        $itemInventories = $query->paginate(10);

        $itemInventories->appends(['search' => $request->search]);

        return view('administrator.item_inventories.index', compact('itemInventories'));
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
                // 'code' => 'nullable',
                'name' => 'required|unique:item_inventories|max:255'
            ]);

            // $validatedData['code'] = $this->generateItemCode($request);

            ItemInventory::create($validatedData);
            
            return redirect()->route('iteminventories.index')->with('success', 'Barang berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemInventory $itemInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemInventory $itemInventory)
    {
        return view('administrator.item_inventories.edit', compact('itemInventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemInventory $itemInventory)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:item_inventories,name,' . $itemInventory->id . '|max:255',
            ]);
            
            $itemInventory->update($validatedData);
        
            return redirect()->route('iteminventories.index')->with('success', 'Barang berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemInventory $itemInventory)
    {
        try {
            $itemInventory->delete();
            
            return redirect()->route('iteminventories.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Barang tidak dapat dihapus.');
        }
    }

    // private function generateItemCode(Request $request)
    // {
    //     if ($request->filled('code')) {
    //         return 'PU/' . $request->code;
    //     }

    //     return null;
    // }

}
