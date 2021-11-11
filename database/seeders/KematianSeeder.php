<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kematian;
use Illuminate\Support\Facades\Hash;

class KematianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Kematian::factory()->count(5)->create();
    }
}
