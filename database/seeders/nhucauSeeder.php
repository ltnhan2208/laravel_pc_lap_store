<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class nhucauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhucau')->insert([
            'ncTen' => "Văn phòng",
        ]);
        DB::table('nhucau')->insert([
            'ncTen' => "Gaming",
        ]);
        DB::table('nhucau')->insert([
            'ncTen' => "Đồ họa",
        ]);
    }
}
