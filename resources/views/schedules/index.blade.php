@extends('layouts.app')

@section('title', 'จัดการเวลาทำการ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🕐 จัดการเวลาทำการ</h2>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">+ เพิ่มตารางเวลา</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>วัน</th>
                <th>เวลาเปิด</th>
                <th>เวลาปิด</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)
                <tr>
                    <td><strong>{{ $schedule->day_of_week }}</strong></td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>
                        @if ($schedule->is_open)
                            <span class="badge bg-success">เปิดร้าน</span>
                        @else
                            <span class="badge bg-danger">ปิดร้าน</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                        <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('ลบตารางเวลานี้?')">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">ยังไม่มีตารางเวลา</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection