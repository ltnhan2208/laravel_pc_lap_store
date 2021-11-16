<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietthuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietthu', function (Blueprint $table) {
            $table->integer('thuMa');
            $table->integer('hdMa');
            $table->engine = "InnoDB";
            
            $table->foreign('thuMa')->references('thuMa')->on('thu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hdMa')->references('hdMa')->on('donhang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietthu');
    }
}
