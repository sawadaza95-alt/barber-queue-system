<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticsController;

// ==================== หน้าแรก ====================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== Dashboard (ตามบทบาท) ====================
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// ==================== ลูกค้า - ต้อง Login ====================
Route::middleware('auth')->group(function () {
    Route::resource('bookings', BookingController::class);
    Route::post('/bookings/{booking}/reschedule', [BookingController::class, 'reschedule'])->name('bookings.reschedule');
});

// ==================== บริการ (Services) - สำหรับแอดมิน ====================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('services', ServiceController::class);
});

// ==================== ตารางเวลา (Schedules) - สำหรับแอดมิน ====================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('schedules', ScheduleController::class);
});

// ==================== แอดมิน Dashboard ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/queue', [AdminController::class, 'queue'])->name('admin.queue');
    Route::post('/call-queue', [AdminController::class, 'callQueue'])->name('admin.call-queue');
    Route::get('/call-history', [AdminController::class, 'callHistory'])->name('admin.call-history');
    Route::post('/bookings/{booking}/confirm', [AdminController::class, 'confirmBooking'])->name('admin.confirm-booking');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::get('/statistics/export', [StatisticsController::class, 'export'])->name('statistics.export');
});

// ==================== Authentication Routes (Breeze) ====================
require __DIR__.'/auth.php';