<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $appends = ['deliveryDateInDays'];

    public function getDeliveryDateInDaysAttribute(): int
    {
        return Carbon::parse($this->shipment_date)->diffInDays(Carbon::parse($this->delivery_date));
    }

    public function scopeWithZipCode($query, $zipCode)
    {
        return $query->where('zip_code', $zipCode);
    }

    public function scopeOrNearestZipCodes($query, $zipCode)
    {
        $nearestZipCodes = $this->getNearestZipCodes($zipCode);

        return $query->orWhereIn('zip_code', $nearestZipCodes);
    }

    public function scopeBetweenTwoMonths($query, $dateRange)
    {
        return $query->whereBetween('delivery_date', [Carbon::createFromDate(month: $dateRange[0]), Carbon::createFromDate(month: $dateRange[1])]);
    }

    public function scopeStartingWithMonth($query, $dateRange)
    {
        return $query->whereBetween('delivery_date', [Carbon::createFromDate(month: $dateRange), Carbon::now()->subMonth()]);
    }

    public function scopeMinusTenDays($query)
    {
        $query->whereBetween('delivery_date', [Carbon::now()->subDays(10), Carbon::now()]);
    }

    public function scopeBetweenDates($query, $dates)
    {
        $query->whereBetween('created_at', [Carbon::parse($dates[0]), Carbon::parse($dates[1])]);
    }

    public function scopeLastMonth($query)
    {
        $query->where('created_at', '<', Carbon::parse($this->created_at)->subMonth());
    }

    public function scopeLastThreeMonths($query)
    {
        $query->where('created_at', '<', Carbon::parse($this->created_at)->subMonths(3));
    }

    /*
        This should determine which zip codes are closest to the passed zip code
        I have hard coded some magical relations between the codes for simplicities sake
        In a realistic scenario I would have a table which would hold which zip codes are closer to each and
        maybe a distance column in case there isn't any zip code which is close
    */
    private function getNearestZipCodes($zipCode): array
    {
        // zip codes which I hard coded into the historical data
        $zipCodes = [
            '030993', '312545', '754323', '461235', '163267'
        ];

        /*
            Basically zip 0 is close to 4 and 1 on the map but 4 and 1 are not close to each other
            The other zips are not close to any other points either
            875234 is close to zip 2 but doesn't actually exist in our database
        */
        return match ($zipCode) {
            $zipCodes[0] => [$zipCodes[4], $zipCodes[1]],
            $zipCodes[1], $zipCodes[4] => [$zipCodes[0]],
            '875234' => [$zipCodes[2]],
            default => []
        };
    }
}
