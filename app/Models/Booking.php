<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'service_id',
        'booking_date',
        'status',
        'queue_number',
        'notes',
    ];

    // ✅ แปลง booking_date เป็น Carbon object
    protected $casts = [
        'booking_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship: Booking มี Service หนึ่ง
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}