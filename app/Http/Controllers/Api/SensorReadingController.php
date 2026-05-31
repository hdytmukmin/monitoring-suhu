<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSensorReadingRequest;
use App\Http\Resources\TemperatureReadingResource;
use App\Services\TemperatureMonitoringService;
use Illuminate\Http\JsonResponse;

class SensorReadingController extends Controller
{
    public function __invoke(
        StoreSensorReadingRequest $request,
        TemperatureMonitoringService $monitoringService
    ): JsonResponse {
        $token = (string) $request->bearerToken();

        if ($token === '') {
            return response()->json([
                'message' => 'Bearer token wajib dikirim.',
            ], 401);
        }

        $reading = $monitoringService->storeReading($request->validated(), $token);

        return (new TemperatureReadingResource($reading))
            ->response()
            ->setStatusCode(201);
    }
}
