<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePcDailyCheckMonthlyReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function isVerified($role)
    {
        // Lakukan pengecekan apakah tanda tangan sesuai dengan peran
        switch ($role) {
            case '4':
                return !is_null($this->teknisi_signature);
                break;
            case '2':
                return !is_null($this->kabag_signature);
                break;
            case '8':
                return !is_null($this->wakil_rektor_signature);
                break;
            default:
                return false;
        }
    }


}
