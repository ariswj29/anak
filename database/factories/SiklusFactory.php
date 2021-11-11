<?php

namespace Database\Factories;

use App\Models\Siklus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiklusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siklus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'siklus_id' => $this->faker->randomDigitNotNull,
            'farm_id' => $this->faker->randomDigitNotNull,
            'nama_siklus' => $this->faker->randomDigit,
            'tanggal' => $this->faker->date(),
            'jenis_ternak' => $this->faker->dayOfWeek,
            'jumlah_ternak' => $this->faker->numberBetween($min = 25, $max = 1000),
            'harga_satuan_doc' => $this->faker->randomNumber(6),
            'supplier' => $this->faker->lastName(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'deleted_at' => $this->faker->date(),
        ];
    }
}
