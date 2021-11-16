<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhgiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhgia', function (Blueprint $table) {
            $table->integer('dgMa')->primary();
            $table->string('dgNoidung');
            $table->timestamp('dgNgay');
            $table->integer('dgTrangthai');
            $table->integer('khMa');
            $table->integer('spMa');
            $table->engine = "InnoDB";

            //foreign key
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade');
            $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danhgia');
    }
}
