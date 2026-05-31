<?php

use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\NotificationLogController;
use App\Http\Controllers\Admin\NotificationSettingController;
use App\Http\Controllers\Admin\ReadingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard.index')->name('dashboard');
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
    Route::patch('/devices/{device}/token', [DeviceController::class, 'regenerateToken'])->name('devices.token');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');

    Route::get('/readings', [ReadingController::class, 'index'])->name('readings.index');

    Route::get('/notifications', [NotificationSettingController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create', [NotificationSettingController::class, 'create'])->name('notifications.create');
    Route::get('/notifications/{notificationSetting}/edit', [NotificationSettingController::class, 'edit'])->name('notifications.edit');

    Route::get('/notification-logs', [NotificationLogController::class, 'index'])->name('notification-logs.index');
});
