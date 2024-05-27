<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppChecking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function application()
    {
        return $this->belongsTo(WebApp::class, 'web_app_id');
    }

    public function isVerified($year, $month, $role)
    {
        // $monthNum = $this->getMonthNumber($month);
        
        $monthlyReport = AppChekingReport::where([
            'year' => $year,
            'month' => $month
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {
        $monthlyReport = AppChekingReport::where([
            'year' => $this->year,
            'month' => $this->month
        ])->first();

        if ($monthlyReport) {
            return !is_null($monthlyReport->teknisi_signature) &&
                !is_null($monthlyReport->kabag_signature) &&
                !is_null($monthlyReport->wakil_rektor_signature);
        }

        return false;
    }
}
