<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietdonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->integer('hdMa');
            $table->integer('spMa');
            $table->float('cthdGia',20,2);
            $table->char('serMa',20)->nullable();
            $table->integer('cthdTrigiakm')->default(0);
            $table->engine = "InnoDB";
            
            //foreign key
            $table->foreign('hdMa')->references('hdMa')->on('donhang')->onDelete('cascade');
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
        Schema::dropIfExists('chitietdonhang');
    }
}
