<?php

namespace Database\Factories;

use App\Models\Vitamin;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class VitaminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vitamin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vitamin_id' => $this->faker->randomDigitNotNull,
            'siklus_id' => $this->faker->randomDigitNotNull,
            'jenis_vitamin' => $this->faker->lastName,
            'jumlah_vitamin' => $this->faker->randomDigit,
            'tanggal' => $this->faker->date(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
