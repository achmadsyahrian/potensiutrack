<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabDailyCheck extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }
    
    public function mandatoryUser()
    {
        return $this->belongsTo(User::class, 'mandatory_user_id');
    }

    public function optionalUser()
    {
        return $this->belongsTo(User::class, 'optional_user_id');
    }

}
