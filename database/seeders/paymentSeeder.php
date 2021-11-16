<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'pmName'=>"momo",
            'partnerCode' => "MOMOBKUN20180529",
            'accessKey' => "klm05TvNBzhg7h7j",
            'endpoint' => "https://test-payment.momo.vn/gw_payment/transactionProcessor",
            'serectkey'=> "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa" ,
            'extraData'=>"STUCPT",
            'pmStatus'=>0,
        ]);
    }
}
