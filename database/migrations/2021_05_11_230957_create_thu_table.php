<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thu', function (Blueprint $table) {
            $table->integer('thuMa')->increments()->primary();
            $table->timestamp('thuNgaylap');
            $table->timestamp('thuNgaybd');
            $table->timestamp('thuNgaykt');
            $table->integer('thuSoluong');
            $table->integer('thuTongtien');
            $table->text('thuGhichu')->nullable();
            $table->integer('adMa');
            $table->engine = "InnoDB";
            
            $table->foreign('adMa')->references('adMa')->on('admin')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thu');
    }
}
