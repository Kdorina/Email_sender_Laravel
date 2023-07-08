<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Reservation extends Model
{

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    use HasFactory;
    protected $fillable = [
        "first_name",
        "email",
        "phone_number",
        "messages",
        "res_date",
        "admin_id"
    ];

}
