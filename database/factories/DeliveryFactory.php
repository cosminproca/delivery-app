<?php

namespace Database\Factories;

use App\Models\Delivery;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shipment_date = Carbon::parse($this->faker->dateTimeBetween('-1 years'))->subWeekDays(14);
        $delivery_date = Carbon::parse($shipment_date)->addWeekDays($this->faker->numberBetween(3,14));

        return [
            'zip_code' => $this->faker->randomElement(['030993', '312545', '754323', '461235', '163267']),
            'shipment_date' => $shipment_date,
            'delivery_date' => $delivery_date,
        ];
    }
}
