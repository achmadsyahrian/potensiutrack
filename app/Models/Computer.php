<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lab_id'];
    
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }
}
