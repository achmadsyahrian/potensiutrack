<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }
    public function labDailyChecks()
    {
        return $this->hasMany(LabDailyCheck::class);
    }
}
