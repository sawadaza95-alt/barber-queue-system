<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueCall extends Model
{
    protected $fillable = ['booking_id', 'queue_number', 'called_at', 'status'];

    // Relationship: QueueCall เป็นของ Booking หนึ่ง
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}