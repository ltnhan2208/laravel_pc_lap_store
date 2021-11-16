<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('pmId');
            $table->string('pmName',30);
            $table->char('endpoint',200);
            $table->char('partnerCode',200);
            $table->char('accessKey',200);
            $table->char('serectkey',200);
            $table->string('extraData',50);
            $table->integer('pmStatus');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
