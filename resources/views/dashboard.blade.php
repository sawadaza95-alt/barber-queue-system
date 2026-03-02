@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="mb-4">👋 สวัสดี, {{ auth()->user()->name }}!</h2>
    </div>
</div>

@php
    $userBookings = auth()->user()->bookings ?? collect();
    $totalBookings = $userBookings->count();
    $completedBookings = $userBookings->where('status', 'completed')->count();
    $pendingBookings = $userBookings->whereIn('status', ['pending', 'confirmed'])->count();
@endphp

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h6 class="card-title">การจองทั้งหมด</h6>
                <h2>{{ $totalBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6 class="card-title">เสร็จสิ้น</h6>
                <h2>{{ $completedBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6 class="card-title">รอการจัดการ</h6>
                <h2>{{ $pendingBookings }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📋 การจองล่าสุด</h5>
            <a href="{{ route('bookings.create') }}" class="btn btn-sm btn-primary">+ จองคิวใหม่</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>หมายเลขคิว</th>
                        <th>บริการ</th>
                        <th>วันเวลา</th>
                        <th>สถานะ</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($userBookings->sortByDesc('created_at')->take(5) as $booking)
                        <tr>
                            <td><strong>#{{ $booking->queue_number ?? '-' }}</strong></td>
                            <td>{{ $booking->service->name ?? '-' }}</td>
                            <td>{{ $booking->booking_date->format('d/m/Y H:i') ?? '-' }}</td>
                            <td>
                                @if ($booking->status === 'pending')
                                    <span class="badge bg-warning">รอยืนยัน</span>
                                @elseif ($booking->status === 'confirmed')
                                    <span class="badge bg-success">ยืนยันแล้ว</span>
                                @elseif ($booking->status === 'completed')
                                    <span class="badge bg-info">เสร็จสิ้น</span>
                                @elseif ($booking->status === 'cancelled')
                                    <span class="badge bg-danger">ยกเลิก</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">ดู</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                ยังไม่มีการจอง <a href="{{ route('bookings.create') }}">จองเดี๋ยวนี้</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($totalBookings > 0)
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary btn-sm">ดูรายการทั้งหมด</a>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">ℹ️ ข้อมูลส่วนตัว</h5>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>ชื่อ:</strong> {{ auth()->user()->name }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p class="mb-2"><strong>เบอร์โทร:</strong> {{ auth()->user()->phone ?? '-' }}</p>
                <p class="mb-2"><strong>บทบาท:</strong> 
                    @if (auth()->user()->role === 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-primary">Customer</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">💬 ลิงค์ด่วน</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('bookings.create') }}" class="list-group-item list-group-item-action">
                        ➕ จองคิวใหม่
                    </a>
                    <a href="{{ route('bookings.index') }}" class="list-group-item list-group-item-action">
                        📋 ดูรายการจองของฉัน
                    </a>
                    <a href="/" class="list-group-item list-group-item-action">
                        🏠 กลับหน้าแรก
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection