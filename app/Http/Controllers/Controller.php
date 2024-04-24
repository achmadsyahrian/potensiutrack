<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function saveSignature($base64Signature)
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
