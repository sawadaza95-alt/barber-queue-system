@extends('layouts.app')

@section('title', 'แก้ไขตารางเวลา')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>✏️ แก้ไขตารางเวลา</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="day_of_week" class="form-label">วัน</label>
                <select class="form-control @error('day_of_week') is-invalid @enderror" 
                        id="day_of_week" name="day_of_week" required>
                    <option value="">-- เลือกวัน --</option>
                    <option value="Monday" {{ $schedule->day_of_week == 'Monday' ? 'selected' : '' }}>จันทร์</option>
                    <option value="Tuesday" {{ $schedule->day_of_week == 'Tuesday' ? 'selected' : '' }}>��ังคาร</option>
                    <option value="Wednesday" {{ $schedule->day_of_week == 'Wednesday' ? 'selected' : '' }}>พุธ</option>
                    <option value="Thursday" {{ $schedule->day_of_week == 'Thursday' ? 'selected' : '' }}>พฤหัส</option>
                    <option value="Friday" {{ $schedule->day_of_week == 'Friday' ? 'selected' : '' }}>ศุกร์</option>
                    <option value="Saturday" {{ $schedule->day_of_week == 'Saturday' ? 'selected' : '' }}>เสาร์</option>
                    <option value="Sunday" {{ $schedule->day_of_week == 'Sunday' ? 'selected' : '' }}>อาทิตย์</option>
                </select>
                @error('day_of_week') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">เวลาเปิด</label>
                <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                       id="start_time" name="start_time" value="{{ $schedule->start_time }}" required>
                @error('start_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">เวลาปิด</label>
                <input type="time" class="form-control @error('end_time') is-invalid @enderror" 
                       id="end_time" name="end_time" value="{{ $schedule->end_time }}" required>
                @error('end_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="is_open" class="form-label">สถานะ</label>
                <select class="form-control @error('is_open') is-invalid @enderror" 
                        id="is_open" name="is_open" required>
                    <option value="1" {{ $schedule->is_open == 1 ? 'selected' : '' }}>เปิด</option>
                    <option value="0" {{ $schedule->is_open == 0 ? 'selected' : '' }}>ปิด</option>
                </select>
                @error('is_open') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">💾 บันทึก</button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">❌ ยกเลิก</a>
            </div>
        </form>
    </div>
</div>
@endsection