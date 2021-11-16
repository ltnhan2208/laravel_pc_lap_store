<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class loaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai')->insert([
            'loaiTen' => "Laptop",
        ]);
        DB::table('loai')->insert([
            'loaiTen' => "PC",
        ]);
    }
}
