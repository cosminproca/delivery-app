<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateEstimatedDeliveryDateRequest;
use App\Services\DeliveryService;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    protected DeliveryService $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function calculateEstimatedDeliveryDate(CalculateEstimatedDeliveryDateRequest $request): JsonResponse
    {
        $validated_data = $request->validated();

        $estimateDelivery = $this->deliveryService->estimateDeliveryDate($validated_data['zip_code'], $validated_data['date_range'] ?? null);

        return response()->json($estimateDelivery);
    }
}
