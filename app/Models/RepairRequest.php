<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairRequest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function itemInventory()
    {
        return $this->belongsTo(ItemInventory::class);
    }

}
