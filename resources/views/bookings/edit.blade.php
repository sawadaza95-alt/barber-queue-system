@extends('layouts.app')

@section('title', 'จองคิว')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📅 จองคิวตัดผม</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">ชื่อ-นามสกุล *</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                               id="customer_name" name="customer_name" placeholder="เช่น สมชาย ใจดี" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">เบอร์โทรศัพท์ *</label>
                        <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" 
                               id="customer_phone" name="customer_phone" placeholder="เช่น 0812345678" required>
                        @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="service_id" class="form-label">เลือกบริการ *</label>
                        <select class="form-select @error('service_id') is-invalid @enderror" 
                                id="service_id" name="service_id" required>
                            <option value="">-- เลือกบริการ --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }} ({{ $service->duration }} นาที - ฿{{ $service->price }})
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="booking_date" class="form-label">วันและเวลาที่ต้องการ *</label>
                        <input type="datetime-local" class="form-control @error('booking_date') is-invalid @enderror" 
                               id="booking_date" name="booking_date" required 
                               min="{{ now()->format('Y-m-d\TH:i') }}">
                        <small class="form-text text-muted">
                            ❗ เลือกวันเวลาอย่างน้อย 30 นาทีจากตอนนี้
                        </small>
                        @error('booking_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">หมายเหตุเพิ่มเติม</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" 
                                  placeholder="เช่น ต้องการตัดผมหลวม ฯลฯ"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">📅 จองคิว</button>
                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ✅ ตั้งค่า minimum datetime เป็นเวลาปัจจุบัน
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        now.setMinutes(now.getMinutes() + 30); // เพิ่ม 30 นาที
        
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('booking_date').setAttribute('min', minDateTime);
    });
</script>
@endsection