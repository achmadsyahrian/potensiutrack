<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\NetworkTroubleshooting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkTroubleshootingController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $networkTroubleshootings = NetworkTroubleshooting::where('reported_by_id', $logUserId)->paginate(10);

        return view('employee.network_troubleshooting.index', compact('networkTroubleshootings'));
    }

    public function show(NetworkTroubleshooting $id)
    {
        $networkTroubleshooting = $id;
        return view('employee.network_troubleshooting.show', compact('networkTroubleshooting'));
    }

    public function verify(NetworkTroubleshooting $id, Request $request)
    {
        $networkTroubleshooting = $id;
        $validated = $request->validate([
            'reporter_signature' => 'required',
        ]);
        $networkTroubleshooting->status = 3;

        $signaturePath = $this->saveSignature($validated['reporter_signature']);
        $networkTroubleshooting->reporter_signature = $signaturePath;
        
        $networkTroubleshooting->save();
        return redirect()->route('employee.networktroubleshooting.index')->with('success', 'Permohonan berhasil di verifikasi');
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
