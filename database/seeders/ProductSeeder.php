<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('products')->insert([
            'order_num' => Str::random(12),
            'name' => Str::random(100),
            'order_date' => now(),
            'user_id'=>3

            
        ]);
    }
}
