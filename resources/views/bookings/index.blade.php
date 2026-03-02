@extends('layouts.app')

@section('title', 'รายการจอง')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 รายการจอง</h2>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">+ จองคิวใหม่</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>หมายเลขคิว</th>
                <th>ชื่อลูกค้า</th>
                <th>เบอร์โทร</th>
                <th>บริการ</th>
                <th>วันเวลา</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td><strong>#{{ $booking->queue_number ?? '-' }}</strong></td>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->customer_phone }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->booking_date->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($booking->status === 'pending')
                            <span class="badge bg-warning">รอยืนยัน</span>
                        @elseif ($booking->status === 'confirmed')
                            <span class="badge bg-success">ยืนยันแล้ว</span>
                        @elseif ($booking->status === 'completed')
                            <span class="badge bg-info">เสร็จสิ้น</span>
                        @elseif ($booking->status === 'cancelled')
                            <span class="badge bg-danger">ยกเลิก</span>
                        @elseif ($booking->status === 'rescheduled')
                            <span class="badge bg-secondary">เลื่อนแล้ว</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">ดู</a>
                        <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('ยกเลิกการจองนี้?')">ยกเลิก</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        ยังไม่มีการจอง <a href="{{ route('bookings.create') }}">จองคิวเลย</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection