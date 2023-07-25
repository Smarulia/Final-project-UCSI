<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPAL extends Model
{
    use HasFactory;

    protected $table = 'booking_pals';
    protected $guarded = [];
}
