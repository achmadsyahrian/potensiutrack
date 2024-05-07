<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebDevelopmentMonthlyReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function isVerified($role)
    {
        // Lakukan pengecekan apakah tanda tangan sesuai dengan peran
        switch ($role) {
            case '7':
                return !is_null($this->puskom_signature);
                break;
            case '2':
                return !is_null($this->kabag_signature);
                break;
            case '8':
                return !is_null($this->wakil_rektor_signature);
                break;
            default:
                return false;
        }
    }
    
}
