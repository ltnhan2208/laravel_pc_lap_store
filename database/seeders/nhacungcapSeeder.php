<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class nhacungcapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhacungcap')->insert([
            'nccTen' => "ACER",
            'nccSdt' => "0392522094",
            'nccDiachi' => "180 Cao lỗ",
            'nccTinhtrang'=> 0 ,
        ]);
        DB::table('nhacungcap')->insert([
             'nccTen' => "Nguyễn Kim",
            'nccSdt' => "0892522094",
            'nccDiachi' => "180 Cao lỗ",
            'nccTinhtrang'=> 0 ,
        ]);
        DB::table('nhacungcap')->insert([
             'nccTen' => "GVN",
            'nccSdt' => "0396522094",
            'nccDiachi' => "180 Cao lỗ",
            'nccTinhtrang'=> 0 ,
        ]);
    }   
}
