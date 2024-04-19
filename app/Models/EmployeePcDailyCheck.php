<?php

namespace App\Models;

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
}
