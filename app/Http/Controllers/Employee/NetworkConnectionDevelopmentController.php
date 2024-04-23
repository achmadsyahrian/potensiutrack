<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\NetworkConnectionDevelopment;
use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkConnectionDevelopmentController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $networkDevelopment = NetworkConnectionDevelopment::where('reported_by_id', $logUserId)->paginate(10);

        return view('employee.network_development.index', compact('networkDevelopment'));
    }

    public function show(NetworkConnectionDevelopment $id)
    {
        $networkDevelopment = $id;
        return view('employee.network_development.show', compact('networkDevelopment'));
    }

    public function verify(NetworkConnectionDevelopment $id, Request $request)
    {
        $networkDevelopment = $id;
        $validated = $request->validate([
            'reporter_signature' => 'required',
        ]);
        $networkDevelopment->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature']);
        $networkDevelopment->reporter_signature = $signaturePath;
        
        $networkDevelopment->save();
        return redirect()->route('employee.networkdev.index')->with('success', 'Permohonan berhasil di verifikasi');
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
}
