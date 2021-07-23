<?php

namespace App\Rules;

use App\Enums\DateRangeType;
use App\Traits\DetermineDateRangeType;
use Illuminate\Contracts\Validation\Rule;

class DateRange implements Rule
{
    use DetermineDateRangeType;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $dateRangeType = $this->determineDateRangeType($value);

        return match($dateRangeType) {
            DateRangeType::MinusTenDays, DateRangeType::BetweenTwoMonths, DateRangeType::StartingWithMonth=> true,
            default => false
        };
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute format is invalid.';
    }
}
