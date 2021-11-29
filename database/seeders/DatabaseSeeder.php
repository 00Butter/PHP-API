<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt( 'password' ),
            'name' => Str::random(20),
            'nickname' => Str::random(30),
            'phone' => '0101111111',
            
        ]);
       // User::factory()->times(9)->create();
    }
}
