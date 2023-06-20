<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "phone_number",
        "messages",
        "res_date"
    ];
    protected $dates = [
        "res_date"

    ];
}
