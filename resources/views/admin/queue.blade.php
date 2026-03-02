@extends('layouts.app')

@section('title', 'เรียกคิว')

@section('content')
<div class="text-center">
    <h2 class="mb-4">📞 ระบบเรียกคิว</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h1 id="current-queue" style="font-size: 4rem; color: #667eea;">--</h1>
            <p class="text-muted">หมายเลขคิวปัจจุบัน</p>
        </div>
    </div>

    <button class="btn btn-success btn-lg" id="call-next-btn">
        📣 เรียกคิวถัดไป
    </button>

    <hr class="my-4">

    <h5 class="mb-3">📋 คิวที่รอ:</h5>
    <div class="list-group">
        @forelse ($bookings as $booking)
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="mb-1">#{{ $booking->queue_number }}</h6>
                        <p class="mb-0"><strong>{{ $booking->customer_name }}</strong> - {{ $booking->service->name }}</p>
                        <small class="text-muted">{{ $booking->booking_date->format('H:i') }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted py-4">ไม่มีคิวรอ</p>
        @endforelse
    </div>
</div>

<script>
    document.getElementById('call-next-btn').addEventListener('click', function() {
        fetch('{{ route("admin.call-queue") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('เรียกคิวสำเร็จ!');
                location.reload();
            } else {
                alert(data.message);
            }
        });
    });
</script>
@endsection