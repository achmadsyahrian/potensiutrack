<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebAssignment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programmer()
    {
        return $this->belongsTo(User::class, 'programmer_id');
    }

    public function assignmentTypeDisplay()
    {
        if ($this->assignment_type === 'maintenance') {
            return 'Maintenance';
        } elseif ($this->assignment_type === 'development') {
            return 'Pengembangan';
        }
    }

    public function isVerified($year, $role)
    {

        $monthlyReport = WebAssignmentReport::where([
            'year' => $year
        ])->first();

        // Periksa apakah sudah diverifikasi
        return $monthlyReport ? $monthlyReport->isVerified($role) : false;
    }

    public function allSignaturesExist()
    {

        $monthlyReport = WebAssignmentReport::where([
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
