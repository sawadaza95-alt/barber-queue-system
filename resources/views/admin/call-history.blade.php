@extends('layouts.app')

@section('title', 'ประวัติเรียกคิว')

@section('content')
<h2 class="mb-4">📜 ประวัติการเรียกคิว (วันนี้)</h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>หมายเลขคิว</th>
                <th>ชื่อลูกค้า</th>
                <th>บริการ</th>
                <th>เวลาเรียก</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($queueCalls as $call)
                <tr>
                    <td><strong>#{{ $call->queue_number }}</strong></td>
                    <td>{{ $call->booking->customer_name }}</td>
                    <td>{{ $call->booking->service->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($call->called_at)->format('H:i:s') }}</td>
                    <td>
                        @if ($call->status === 'waiting')
                            <span class="badge bg-warning">รอการเรียก</span>
                        @elseif ($call->status === 'called')
                            <span class="badge bg-info">เรียกแล้ว</span>
                        @elseif ($call->status === 'completed')
                            <span class="badge bg-success">เสร็จสิ้น</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">ยังไม่มีการเรียกคิว</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">กลับ</a>
@endsection