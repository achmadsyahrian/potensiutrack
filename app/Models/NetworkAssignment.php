<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkAssignment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function engineer()
    {
        return $this->belongsTo(User::class, 'engineer_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function assignmentTypeDisplay()
    {
        if ($this->assignment_type === 'troubleshooting') {
            return 'Penanganan';
        } elseif ($this->assignment_type === 'development') {
            return 'Pengembangan';
        }
    }

    public function isVerified($year, $role)
    {

        $monthlyReport = NetworkAssignmentReport::where([
            'year' => $year
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {

        $monthlyReport = NetworkAssignmentReport::where([
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
