<?php

use App\Http\Controllers\Api\SensorReadingController;
use Illuminate\Support\Facades\Route;

Route::post('/sensor-readings', SensorReadingController::class)
    ->middleware('throttle:sensor-readings')
    ->name('api.sensor-readings.store');
