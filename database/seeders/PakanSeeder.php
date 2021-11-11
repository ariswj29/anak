<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pakan;
use Illuminate\Support\Facades\Hash;

class PakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pakan::factory()->count(10)->create();
    }
}
