<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $user = User::where('email', 'admin@gmail.com')->first();
        
        // if (!$user){
            
        //     User::create([
        //         "name" => "admin",
        //         "email" => "admin@gmail.com",
        //         "hak_akses" =>"administrator",
        //         "password" => Hash::make('mardawaGO!!')
        //         ]);
    
        //         $this->command->info('User table seeded!');
        // }
        \App\Models\User::factory()->count(7)->create();
    }
}
