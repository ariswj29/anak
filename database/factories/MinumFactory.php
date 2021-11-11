<?php

namespace Database\Factories;

use App\Models\Minum;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class MinumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Minum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'minum_id' => $this->faker->randomDigitNotNull,
            'siklus_id' => $this->faker->randomDigitNotNull,
            'jumlah_minum' => $this->faker->randomDigit,
            'tanggal' => $this->faker->date(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
