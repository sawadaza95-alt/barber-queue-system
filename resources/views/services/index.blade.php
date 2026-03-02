@extends('layouts.app')

@section('title', 'จัดการบริการ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>✂️ จัดการบริการ</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary">+ เพิ่มบริการใหม่</a>
</div>

<div class="row">
    @forelse ($services as $service)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text text-muted">{{ $service->description }}</p>
                    <p class="mb-1"><strong>ระยะเวลา:</strong> {{ $service->duration }} นาที</p>
                    <p class="mb-3"><strong>ราคา:</strong> <span class="text-success fs-5">฿{{ number_format($service->price, 2) }}</span></p>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('ลบบริการนี้?')">ลบ</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                ยังไม่มีบริการ <a href="{{ route('services.create') }}">เพิ่มบริการ</a>
            </div>
        </div>
    @endforelse
</div>
@endsection