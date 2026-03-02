@extends('layouts.app')

@section('title', 'รายละเอียดการจอง')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📋 รายละเอียดการจอง</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">หมายเลขคิว</h6>
                        <h4>{{ $booking->queue_number ? '#' . $booking->queue_number : 'ยังไม่ได้มอบหมาย' }}</h4>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">สถานะ</h6>
                        @if ($booking->status === 'pending')
                            <span class="badge bg-warning fs-6">รอยืนยัน</span>
                        @elseif ($booking->status === 'confirmed')
                            <span class="badge bg-success fs-6">ยืนยันแล้ว</span>
                        @elseif ($booking->status === 'completed')
                            <span class="badge bg-info fs-6">เสร็จสิ้น</span>
                        @elseif ($booking->status === 'cancelled')
                            <span class="badge bg-danger fs-6">ยกเลิก</span>
                        @elseif ($booking->status === 'rescheduled')
                            <span class="badge bg-secondary fs-6">เลื่อนแล้ว</span>
                        @endif
                    </div>
                </div>

                <hr>

                <h6 class="text-muted">ข้อมูลลูกค้า</h6>
                <p class="mb-1"><strong>ชื่อ:</strong> {{ $booking->customer_name }}</p>
                <p class="mb-3"><strong>เบอร์โทร:</strong> {{ $booking->customer_phone }}</p>

                <h6 class="text-muted">ข้อมูลการจอง</h6>
                <p class="mb-1"><strong>บริการ:</strong> {{ $booking->service->name }}</p>
                <p class="mb-1"><strong>ระยะเวลา:</strong> {{ $booking->service->duration }} นาที</p>
                <p class="mb-1"><strong>ราคา:</strong> ฿{{ number_format($booking->service->price, 2) }}</p>
                <p class="mb-1"><strong>วันเวลา:</strong> {{ $booking->booking_date->format('d/m/Y H:i') }}</p>
                <p class="mb-3"><strong>หมายเหตุ:</strong> {{ $booking->notes ?? '-' }}</p>

                <hr>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    @if ($booking->status !== 'cancelled' && $booking->status !== 'completed')
                        <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning">แก้ไข</a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('ยกเลิกการจองนี้?')">ยกเลิก</button>
                        </form>
                    @endif
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">กลับ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection