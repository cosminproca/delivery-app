<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DateRangeType extends Enum
{
    public const MinusTenDays = 0;
    public const BetweenTwoMonths = 1;
    public const StartingWithMonth = 2;
}
