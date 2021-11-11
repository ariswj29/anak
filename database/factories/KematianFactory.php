<?php

namespace Database\Factories;

use App\Models\Kematian;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class KematianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kematian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kematian_id' => $this->faker->randomDigitNotNull,
            'siklus_id' => $this->faker->randomDigitNotNull,
            'tanggal' => $this->faker->date(),
            'jumlah_kematian' => $this->faker->randomDigit,
            'penyebab' => $this->faker->paragraph,
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
