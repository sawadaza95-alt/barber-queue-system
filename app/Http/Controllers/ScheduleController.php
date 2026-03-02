<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // แสดงตารางเวลาทำการ
    public function index()
    {
        $schedules = Schedule::orderBy('day_of_week')->get();
        return view('schedules.index', compact('schedules'));
    }

    // แสดงฟอร์มเพิ่มตารางเวลา
    public function create()
    {
        return view('schedules.create');
    }

    // บันทึกตารางเวลาใหม่
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_open' => 'boolean',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'ตารางเวลาถูกเพิ่มแล้ว');
    }

    // แสดงรายละเอียดตารางเวลา
    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    // แสดงฟอร์มแก้ไขตารางเวลา
    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    // บันทึกการแก้ไขตารางเวลา
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_open' => 'boolean',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'ตารางเวลาถูกอัปเดตแล้ว');
    }

    // ลบตารางเวลา
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'ตารางเวลาถูกลบแล้ว');
    }
}