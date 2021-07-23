<?php

namespace App\Traits;

use App\Enums\DateRangeType;

trait DetermineDateRangeType {
    private function determineDateRangeType($value): ?int
    {
        if($value === 'current_day_minus_ten') {
            return DateRangeType::MinusTenDays;
        }

        if(is_array($value)) {
            return DateRangeType::BetweenTwoMonths;
        }

        if($value >= 1 && $value <= 12) {
            return DateRangeType::StartingWithMonth;
        }

        return null;
    }
}
