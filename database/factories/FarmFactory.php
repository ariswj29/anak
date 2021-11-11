<?php

namespace Database\Factories;

use App\Models\Farm;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class FarmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Farm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'farm_id' => $this->faker->randomDigitNotNull,
            'mitra_id' => $this->faker->randomDigitNotNull,
            'nama_farm' => $this->faker->userName,
            'alamat_farm' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'mata_uang' => $this->faker->currencyCode,
            'satuan_berat' => $this->faker->randomDigitNotNull(),
            'kapasitas_rak_telur' => $this->faker->randomDigitNotNull(),
            'kapasitas_kandang_doc' => $this->faker->randomDigitNotNull(),
            'kapasitas_kandang_grower' => $this->faker->randomDigitNotNull(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
