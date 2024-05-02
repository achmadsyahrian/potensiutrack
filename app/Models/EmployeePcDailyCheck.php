<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePcDailyCheck extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function isVerified($year, $month, $division_id)
    {
        $monthNum = $this->getMonthNumber($month);

        $monthlyReport = EmployeePcDailyCheckMonthlyReport::where([
            'year' => $year,
            'month' => $monthNum, 
            'division_id' => $division_id
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified() : false;
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
