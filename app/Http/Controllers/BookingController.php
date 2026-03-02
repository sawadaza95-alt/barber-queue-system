<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        // ✅ แก้: แปลง datetime-local format เป็น Y-m-d H:i
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date_format:Y-m-d\TH:i', // ✅ แก้ format
            'notes' => 'nullable|string',
        ], [
            'booking_date.date_format' => 'วันเวลาต้องเป็นรูปแบบ YYYY-MM-DD HH:MM',
        ]);

        // ✅ แปลง booking_date จาก datetime-local เป็น Carbon
        $validated['booking_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $validated['booking_date']);
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'จองคิวสำเร็จแล้ว!');
    }

    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $services = Service::all();
        return view('bookings.edit', compact('booking', 'services'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
        ]);

        $validated['booking_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $validated['booking_date']);

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking)->with('success', 'แก้ไขการจองสำเร็จแล้ว!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'ยกเลิกการจองแล้ว!');
    }

    public function reschedule(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'booking_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $validated['booking_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $validated['booking_date']);
        $validated['status'] = 'rescheduled';

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking)->with('success', 'เลื่อนการจองสำเร็จแล้ว!');
    }
}