<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkTroubleshooting extends Model
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

    public function isVerified($year,$role)
    {
        $monthlyReport = NetworkTroubleshootingMonthlyReport::where([
            'year' => $year,
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {

        $monthlyReport = NetworkTroubleshootingMonthlyReport::where([
            'year' => $this->year,
        ])->first();

        if ($monthlyReport) {
            return !is_null($monthlyReport->puskom_signature) &&
                !is_null($monthlyReport->kabag_signature) &&
                !is_null($monthlyReport->wakil_rektor_signature);
        }

        return false;
    }
}
