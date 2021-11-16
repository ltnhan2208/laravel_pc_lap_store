<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\khachhang;
class khachhangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        khachhang::factory()->count(10)->create();
    }
}
