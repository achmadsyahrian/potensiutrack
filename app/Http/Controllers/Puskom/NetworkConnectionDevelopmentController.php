<?php

namespace App\Http\Controllers\Puskom;

use App\Http\Controllers\Controller;
use App\Http\Requests\NetworkDevelopmentStoreRequest;
use App\Models\Division;
use App\Models\NetworkConnectionDevelopment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NetworkConnectionDevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NetworkConnectionDevelopment::query();

        $this->applySearchFilters($query, $request);
        $query->orderBy('date', 'desc');

        $networkDev = $query->paginate(10);
        $networkDev->appends(request()->query());

        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();

        return view('puskom.network_development.index', compact('networkDev', 'employees', 'divisions'));
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
    public function store(NetworkDevelopmentStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $signaturePath = $this->saveSignature($validatedData['puskom_signature']);
            
            $validatedData['puskom_signature'] = $signaturePath;
    
            NetworkConnectionDevelopment::create($validatedData);
            
            return redirect()->route('puskom.networkdev.index')->with('success', 'Permohonan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NetworkConnectionDevelopment $networkConnectionDevelopment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NetworkConnectionDevelopment $network_development)
    {
        $employees = User::where('role_id', 5)->get();
        $divisions = Division::all();
        return view('puskom.network_development.edit', compact('network_development', 'employees', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NetworkConnectionDevelopment $networkConnectionDevelopment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkConnectionDevelopment $network_development)
    {
        try {
            $network_development->delete();
            if ($network_development->puskom_signature) {
                Storage::disk('public')->delete($network_development->puskom_signature);
            }
            if ($network_development->reporter_signature) {
                Storage::disk('public')->delete($network_development->reporter_signature);
            }
            return redirect()->route('puskom.networkdev.index')->with('success', 'Permohonan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Permohonan tidak dapat dihapus.');
        }
    }


    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
        }

        if ($request->filled('search_finish_date')) {
            $query->whereDate('finish_date', $request->search_finish_date);
        }

        if ($request->filled('search_reporter')) {
            $query->where('reported_by_id', $request->search_reporter);
        }

        if ($request->filled('search_status')) {
            $query->where('status', $request->search_status);
        }

    }

    private function saveSignature($base64Signature)
    {
        // Mengubah base64 menjadi data biner gambar
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Signature));

        // Membuat nama file baru dengan ekstensi yang sesuai
        $fileName = 'paraf_' . uniqid() . '.png';

        // Mendapatkan path lengkap ke folder storage/public/signature
        $directory = storage_path('app/public/signature');

        // Membuat folder jika belum ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Menyimpan file gambar ke dalam folder storage/public/signature
        file_put_contents($directory . '/' . $fileName, $imageData);

        // Mengembalikan path lengkap file yang disimpan
        return 'signature/' . $fileName;
    }

    public function markAsComplete(NetworkConnectionDevelopment $id, Request $request)
    {
        $validated = $request->validate([
            'finish_date' => 'required',
        ]);

        $network_development = $id;
        $network_development->status = 2;
        $network_development->finish_date = $validated['finish_date'];
        $network_development->save();
        return redirect()->route('puskom.networkdev.index')->with('success', 'Permohonan berhasil di perbarui');
    }

}
