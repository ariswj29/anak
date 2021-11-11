<?php

namespace Database\Factories;

use App\Models\Kas;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class KasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kas_id' => $this->faker->randomDigitNotNull,
            'siklus_id' => $this->faker->randomDigitNotNull,
            'tanggal' => $this->faker->date(),
            'jenis_transaksi' => $this->faker->word,
            'nominal' => $this->faker->numberBetween($min = 1000, $max = 100000),
            'kategori' => $this->faker->word,
            'catatan' => $this->faker->paragraph,
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
