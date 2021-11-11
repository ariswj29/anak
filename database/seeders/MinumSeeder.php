<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Minum;
use Illuminate\Support\Facades\Hash;

class MinumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Minum::factory()->count(5)->create();
    }
}
