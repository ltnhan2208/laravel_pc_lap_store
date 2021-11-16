<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kho', function (Blueprint $table) {
            $table->integer('spMa');
            $table->integer('khoSoluong');
            $table->timestamp('khoNgaynhap');
            $table->integer('khoSoluongdaban')->default(0);
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
        Schema::dropIfExists('kho');
    }
}
