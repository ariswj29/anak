<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siklus;
use Illuminate\Support\Facades\Hash;

class SiklusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Siklus::factory()->count(7)->create();
    }
}
