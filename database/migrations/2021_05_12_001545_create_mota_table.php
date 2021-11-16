<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mota', function (Blueprint $table) {
            $table->integer('spMa');
            $table->string('ram',150);
            $table->string('cpu',150);
            $table->string('ocung',150);
            $table->string('psu',150)->nullable(true);
            $table->string('vga',150)->nullable(true);
            $table->string('mainboard',150)->nullable(true);
            $table->string('manhinh',150)->nullable(true);
            $table->string('chuot',150)->nullable(true);
            $table->string('banphim',150)->nullable(true);
            $table->string('vocase',150)->nullable(true);
            $table->string('pin',150)->nullable(true);
            $table->string('tannhiet',150)->nullable(true);
            $table->string('loa',150)->nullable(true);
            $table->string('mau',150)->nullable(true);
            $table->string('trongluong',150)->nullable(true);
            $table->string('conggiaotiep',150)->nullable(true);
            $table->string('webcam',150)->nullable(true);
            $table->string('chuanlan',150)->nullable(true);
            $table->string('chuanwifi',150)->nullable(true);
            $table->string('hedieuhanh',150)->nullable(true);
            
            $table->engine = "InnoDB";
            // foreign key
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mota');
    }
}
