<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\QueueCall;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // แสดง Dashboard แอดมิน
    public function dashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $todayBookings = Booking::whereDate('booking_date', today())->get();

        return view('admin.dashboard', compact('totalBookings', 'pendingBookings', 'todayBookings'));
    }

    // แสดงหน้าเรียกคิว
    public function queue()
    {
        $bookings = Booking::where('status', 'confirmed')
            ->whereDate('booking_date', today())
            ->orderBy('booking_date')
            ->get();

        return view('admin.queue', compact('bookings'));
    }

    // เรียกคิวถัดไป
    public function callQueue(Request $request)
    {
        $booking = Booking::where('status', 'confirmed')
            ->whereDate('booking_date', today())
            ->orderBy('booking_date')
            ->first();

        if ($booking) {
            $queueCall = QueueCall::create([
                'booking_id' => $booking->id,
                'queue_number' => $booking->queue_number ?? 1,
                'called_at' => now(),
                'status' => 'called',
            ]);

            $booking->update(['status' => 'completed']);

            return response()->json(['success' => true, 'message' => 'เรียกคิวสำเร็จ']);
        }

        return response()->json(['success' => false, 'message' => 'ไม่มีคิวที่รอการเรียก']);
    }

    // แสดงประวัติคิวที่เรียก
    public function callHistory()
    {
        $queueCalls = QueueCall::with('booking')
            ->whereDate('called_at', today())
            ->orderBy('called_at', 'desc')
            ->get();

        return view('admin.call-history', compact('queueCalls'));
    }

    // ยืนยันการจอง (เปลี่ยนสถานะเป็น confirmed)
    public function confirmBooking(Booking $booking)
    {
        // สร้าง queue number
        $nextQueueNumber = Booking::where('status', '!=', 'cancelled')
            ->max('queue_number') + 1 ?? 1;

        $booking->update([
            'status' => 'confirmed',
            'queue_number' => $nextQueueNumber,
        ]);

        return redirect()->back()->with('success', 'ยืนยันการจองแล้ว');
    }
}