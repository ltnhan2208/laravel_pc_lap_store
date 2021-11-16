<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::factory()->count(1)->create();
    }
}
