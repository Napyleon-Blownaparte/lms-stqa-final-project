<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['flight_code', 'origin', 'destination', 'departure_time', 'arrival_time'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
