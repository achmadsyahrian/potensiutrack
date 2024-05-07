<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkConnectionDevelopment extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by_id');
    }

    public function isVerified($year, $month, $role)
    {
        $monthNum = $this->getMonthNumber($month);

        $monthlyReport = NetworkDevelopmentReport::where([
            'year' => $year,
            'month' => $monthNum, 
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {

        $monthlyReport = NetworkDevelopmentReport::where([
            'year' => $this->year,
            'month' => $this->getMonthNumber($this->month)
        ])->first();

        if ($monthlyReport) {
            return !is_null($monthlyReport->puskom_signature) &&
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
