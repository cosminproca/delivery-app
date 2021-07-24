<?php

namespace Tests\Unit;

use App\Enums\DateRangeType;
use App\Models\Delivery;
use App\Services\DeliveryService;
use Carbon\Carbon;
use Tests\TestCase;

class DeliveryServiceTest extends TestCase
{
    public function test_stored_zip_code_yields_a_date_result()
    {
        $deliveryService = resolve(DeliveryService::class);

        $result = $deliveryService->estimateDeliveryDate('030993');

        $this->assertGreaterThan(Carbon::now()->toDateString(), $result);
    }

    public function test_related_zip_code_yields_a_date_result()
    {
        $deliveryService = resolve(DeliveryService::class);

        $result = $deliveryService->estimateDeliveryDate('875234');

        $this->assertNotEquals('The delivery date cannot be estimated for the given zip code.', $result);
    }

    public function test_unrelated_zip_code_yields_no_result()
    {
        $deliveryService = resolve(DeliveryService::class);

        $result = $deliveryService->estimateDeliveryDate('545143');

        $this->assertEquals('The delivery date cannot be estimated for the given zip code.', $result);
    }

    public function test_date_range_type_is_correctly_identified()
    {
        $deliveryService = resolve(DeliveryService::class);

        $type1 = $deliveryService->determineDateRangeType('current_day_minus_ten');
        $type2 = $deliveryService->determineDateRangeType([1, 5]);
        $type3 = $deliveryService->determineDateRangeType(5);

        $this->assertEquals(DateRangeType::MinusTenDays, $type1);
        $this->assertEquals(DateRangeType::BetweenTwoMonths, $type2);
        $this->assertEquals(DateRangeType::StartingWithMonth, $type3);
    }

    public function test_date_range_type_1_yields_expected_results()
    {
        $deliveryService = resolve(DeliveryService::class);

        $zipCode = '030993';
        $dateRange = 'current_day_minus_ten';

        $historicalData = Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->minusTenDays()->orderBy('delivery_date')->get();

        $correctResult = Carbon::now()->addDays(round(collect($historicalData)->avg('deliveryDateInDays')))->toDateString();

        $result = $deliveryService->estimateDeliveryDate($zipCode, $dateRange);

        $this->assertEquals($correctResult, $result);
    }

    public function test_date_range_type_2_yields_expected_results()
    {
        $deliveryService = resolve(DeliveryService::class);

        $zipCode = '030993';
        $dateRange = [1, 5];

        $historicalData = Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->betweenTwoMonths($dateRange)->orderBy('delivery_date')->get();

        $correctResult = Carbon::now()->addDays(round(collect($historicalData)->avg('deliveryDateInDays')))->toDateString();

        $result = $deliveryService->estimateDeliveryDate($zipCode, $dateRange);

        $this->assertEquals($correctResult, $result);
    }

    public function test_date_range_type_3_yields_expected_results()
    {
        $deliveryService = resolve(DeliveryService::class);

        $zipCode = '030993';
        $dateRange = 5;

        $historicalData = Delivery::withZipCode($zipCode)->orNearestZipCodes($zipCode)->startingWithMonth($dateRange)->orderBy('delivery_date')->get();

        $correctResult = Carbon::now()->addDays(round(collect($historicalData)->avg('deliveryDateInDays')))->toDateString();

        $result = $deliveryService->estimateDeliveryDate($zipCode, $dateRange);

        $this->assertEquals($correctResult, $result);
    }
}
