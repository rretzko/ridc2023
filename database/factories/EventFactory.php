<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words($this->faker->numberBetween(1, 5), true),
            'subtitle' => $this->faker->words($this->faker->numberBetween(1, 3), true),
            'descr' => $this->faker->words($this->faker->numberBetween(1, 7), true),
            'open_date' => $this->faker->date(),
            'close_date' => $this->faker->date(),
            'event_date' => $this->faker->date(),
            'start_time' => '09:00:00',
            'end_time' => '23:00:00',
            'ensemble_fee' => '400.00',
            'max_soloists' => 4,
            'max_concert' => 2,
            'max_show' => 2,
        ];
    }
}
