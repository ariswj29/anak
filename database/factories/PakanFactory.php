<?php

namespace Database\Factories;

use App\Models\Pakan;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PakanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pakan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pakan_id' => $this->faker->randomDigitNotNull,
            'siklus_id' => $this->faker->randomDigitNotNull,
            'jenis_pakan' => $this->faker->name,
            'jumlah_pakan' => $this->faker->randomDigit,
            'tanggal' => $this->faker->date(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
