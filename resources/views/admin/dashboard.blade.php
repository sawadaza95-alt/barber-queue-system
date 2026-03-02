@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="mb-4">🔧 Admin Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h6 class="card-title">รวมการจอง</h6>
                <h2>{{ $totalBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h6 class="card-title">รอยืนยัน</h6>
                <h2>{{ $pendingBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h6 class="card-title">วันนี้</h6>
                <h2>{{ $todayBookings->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h6 class="card-title">ดำเนินการ</h6>
                <a href="{{ route('admin.queue') }}" class="btn btn-light btn-sm">เรียกคิว</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">📅 ที่รอยืนยัน</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse ($todayBookings->where('status', 'pending') as $booking)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $booking->customer_name }}</strong><br>
                                    <small class="text-muted">{{ $booking->service->name }}</small>
                                </div>
                                <form action="{{ route('admin.confirm-booking', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">ยืนยัน</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">ไม่มีการจองที่รอยืนยัน</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">🎯 ลิงก์ด่วน</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('admin.queue') }}" class="list-group-item list-group-item-action">
                        📞 เรียกคิวถัดไป
                    </a>
                    <a href="{{ route('admin.call-history') }}" class="list-group-item list-group-item-action">
                        📜 ประวัติการเรียก
                    </a>
                    <a href="{{ route('services.index') }}" class="list-group-item list-group-item-action">
                        ✂️ จัดการบริการ
                    </a>
                    <a href="{{ route('schedules.index') }}" class="list-group-item list-group-item-action">
                        🕐 จัดการเวลาทำการ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection