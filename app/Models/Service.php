<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'duration', 'price'];

    // Relationship: Service มี Bookings หลายอัน
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}