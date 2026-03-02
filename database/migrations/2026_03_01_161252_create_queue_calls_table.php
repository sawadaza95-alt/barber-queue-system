<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('queue_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); // ลิงก์ไปยังการจอง
            $table->integer('queue_number'); // หมายเลขคิวที่เรียก
            $table->timestamp('called_at')->nullable(); // เวลาที่เรียก
            $table->string('status')->default('waiting'); // waiting, called, completed
            $table->timestamps();
            
            // Foreign key
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_calls');
    }
};