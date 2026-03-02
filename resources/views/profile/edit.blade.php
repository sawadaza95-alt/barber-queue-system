@extends('layouts.app')

@section('title', 'แก้ไขโปรไฟล์')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">✏️ แก้ไขโปรไฟล์</h5>
            </div>
            <div class="card-body">
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        โปรไฟล์ถูกอัปเดตแล้ว
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ auth()->user()->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ auth()->user()->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทร</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ auth()->user()->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">บันทึก</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </form>

                <hr class="my-4">

                <div class="card border-danger mt-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">🗑️ ลบบัญชี</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">เมื่อลบบัญชี ข้อมูลทั้งหมดจะถูกลบอย่างถาวร</p>
                        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือ? การลบบัญชีไม่สามารถกู้คืนได้');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">ลบบัญชีของฉัน</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection