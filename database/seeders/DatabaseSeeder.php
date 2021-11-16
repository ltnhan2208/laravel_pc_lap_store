<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(khachhangSeeder::class);
        $this->call(paymentSeeder::class);
        $this->call(adminSeeder::class);
        $this->call(thuonghieuSeeder::class);
        $this->call(loaiSeeder::class);
        $this->call(nhacungcapSeeder::class);
        $this->call(nhucauSeeder::class);
    }
}
