<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiChecking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function building()
    {
        return $this->belongsTo(building::class);
    }
    
}
