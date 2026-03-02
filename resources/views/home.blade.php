@extends('layouts.app')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h1 style="font-size: 3rem;">✂️</h1>
                <h5 class="card-title">จองคิวใหม่</h5>
                <p class="card-text">จองคิวตัดผมออนไลน์อย่างสะดวก</p>
                <a href="{{ route('bookings.create') }}" class="btn btn-primary">จองเดี๋ยวนี้</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h1 style="font-size: 3rem;">📋</h1>
                <h5 class="card-title">ดูลำดับคิว</h5>
                <p class="card-text">ตรวจสอบลำดับคิวของคุณ</p>
                <a href="{{ route('bookings.index') }}" class="btn btn-primary">ดูรายการ</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center h-100">
            <div class="card-body">
                <h1 style="font-size: 3rem;">🔧</h1>
                <h5 class="card-title">จัดการระบบ</h5>
                <p class="card-text">จัดการบริการและตารางเวลา</p>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">ไปแอดมิน</a>
            </div>
        </div>
    </div>
</div>
@endsection