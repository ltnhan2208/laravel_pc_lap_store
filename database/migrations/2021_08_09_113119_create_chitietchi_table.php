<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietchiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietchi', function (Blueprint $table) {
            $table->integer('chiMa');
            $table->integer('pnMa');
            $table->engine = "InnoDB";
            
            $table->foreign('chiMa')->references('chiMa')->on('chi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pnMa')->references('pnMa')->on('phieunhap')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietchi');
    }
}
