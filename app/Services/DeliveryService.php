<?php

namespace App\Services;

use App\Enums\DateRangeType;
use App\Models\Delivery;
use App\Traits\DetermineDateRangeType;
use Carbon\Carbon;

class DeliveryService
{
    use DetermineDateRangeType;

    public function estimateDeliveryDate($zipCode, $dateRange = null)
    {
        $dateRangeType = $this->determineDateRangeType($dateRange);

        $historicalData = match ($dateRangeType) {
            DateRangeType::MinusTenDays => Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->minusTenDays()->orderBy('delivery_date')->get(),
            DateRangeType::BetweenTwoMonths => Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->betweenTwoMonths($dateRange)->orderBy('delivery_date')->get(),
            DateRangeType::StartingWithMonth => Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->startingWithMonth($dateRange)->orderBy('delivery_date')->get(),
            default => Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->orderBy('delivery_date')->get()
        };

        if($historicalData->isEmpty()) {
            return 'The delivery date cannot be estimated for the given zip code.';
        }

        // The estimated delivery date based on the average of the past delivery dates
        return Carbon::now()->addDays(round(collect($historicalData)->avg('deliveryDateInDays')))->toDateString();
    }
}
