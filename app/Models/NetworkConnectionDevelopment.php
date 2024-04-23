<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkConnectionDevelopment extends Model
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
}
