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
    public function isVerified()
    {
        // Lakukan pengecekan apakah tanda tangan kabag sudah ada atau tidak
        return !is_null($this->kabag_signature);
    }
}
