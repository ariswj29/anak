<?php

namespace Database\Factories;

use App\Models\Mitra;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class MitraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mitra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mitra_id' => $this->faker->randomDigitNotNull,
            'pjub_id' => $this->faker->randomDigitNotNull,
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'tanggal_lahir' => $this->faker->date(),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }

    // $factory->define(\App\Models\Mitra::class, function (Faker $faker) {
    //     return [
    //         'mitra_id' => $this->faker->id(8),
    //         'pjub_id' => $this->faker->id(8),
    //         'nama' => $this->faker->sentence(2),
    //         'tempat_lahir' => $this->faker->sentence(1),
    //         'alamat' => $this->faker->sentence(3),
    //         'no_hp' => $this->faker->number(13),
    //         'email' => $this->faker->unique()->safeEmail(),
    //         'tanggal_lahir' => $this->faker->date(),
    //         'created_at' => $this->faker->date(),
    //         'updated_at' => $this->faker->date(),
    //     ];
    // });
}
