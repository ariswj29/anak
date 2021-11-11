<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berat;
use Illuminate\Support\Facades\Hash;

class BeratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Berat::factory()->count(5)->create();
    }
}
