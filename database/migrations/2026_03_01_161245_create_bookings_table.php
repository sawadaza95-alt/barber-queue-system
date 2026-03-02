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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // ชื่อลูกค้า
            $table->string('customer_phone'); // เบอร์โทร
            $table->unsignedBigInteger('service_id'); // ประเภทบริการ
            $table->dateTime('booking_date'); // วันเวลาที่จอง
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('pending');
            $table->integer('queue_number')->nullable(); // หมายเลขคิว
            $table->text('notes')->nullable(); // หมายเหตุ
            $table->timestamps();
            
            // Foreign key
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};