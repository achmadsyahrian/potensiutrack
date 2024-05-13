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
        return $this->belongsTo(Programmer::class);
    }

    public function assignmentTypeDisplay()
    {
        if ($this->assignment_type === 'maintenance') {
            return 'Maintenance';
        } elseif ($this->assignment_type === 'development') {
            return 'Pengembangan';
        }
    }
}
