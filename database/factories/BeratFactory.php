<?php

namespace Database\Factories;

use App\Models\Berat;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class BeratFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Berat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'berat_id' => $this->faker->randomDigitNotNull,
            'jumlah_pakan' => $this->faker->randomDigit,
            'tanggal' => $this->faker->date(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),  
        ];
    }
}
