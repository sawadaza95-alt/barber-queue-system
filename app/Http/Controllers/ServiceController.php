<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // แสดงรายการบริการทั้งหมด
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // แสดงฟอร์มเพิ่มบริการ
    public function create()
    {
        return view('services.create');
    }

    // บันทึกบริการใหม่
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:10',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'บริการถูกเพิ่มแล้ว');
    }

    // แสดงรายละเอียดบริการ
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // แสดงฟอร์มแก้ไขบริการ
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    // บันทึกการแก้ไขบริการ
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:10',
            'price' => 'required|numeric|min:0',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'บริการถูกอัปเดตแล้ว');
    }

    // ลบบริการ
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'บริการถูกลบแล้ว');
    }
}