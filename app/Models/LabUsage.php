<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabUsage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function isVerified($year, $month, $lab_id, $role)
    {
        $monthNum = $this->getMonthNumber($month);

        $monthlyReport = LabUsageMonthlyReport::where([
            'year' => $year,
            'month' => $monthNum, 
            'lab_id' => $lab_id
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {
        // Ambil lab_id dari relasi division
        $lab_id = $this->lab->id;

        $monthlyReport = LabUsageMonthlyReport::where([
            'year' => $this->year,
            'month' => $this->getMonthNumber($this->month), 
            'lab_id' => $lab_id
        ])->first();

        if ($monthlyReport) {
            return !is_null($monthlyReport->teknisi_signature) &&
                !is_null($monthlyReport->kabag_signature) &&
                !is_null($monthlyReport->wakil_rektor_signature);
        }

        return false;
    }

    
    private function getMonthNumber($month)
    {
        $bulanToAngka = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        return $bulanToAngka[$month];
    }
}
