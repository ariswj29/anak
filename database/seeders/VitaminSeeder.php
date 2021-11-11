<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vitamin;
use Illuminate\Support\Facades\Hash;

class VitaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vitamin::factory()->count(5)->create();
    }
}
