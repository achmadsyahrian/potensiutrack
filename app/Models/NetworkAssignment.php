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

}
