<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class thuonghieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('thuonghieu')->insert([
            'thTen' => "ACER",
        ]);
        DB::table('thuonghieu')->insert([
            'thTen' => "HP",
        ]);
        DB::table('thuonghieu')->insert([
            'thTen' => "DELL",
        ]);
        DB::table('thuonghieu')->insert([
            'thTen' => "MSI",
        ]);
        DB::table('thuonghieu')->insert([
            'thTen' => "GVN",
        ]);
        DB::table('thuonghieu')->insert([
            'thTen' => "ASUS",
        ]);
      
    }
}
