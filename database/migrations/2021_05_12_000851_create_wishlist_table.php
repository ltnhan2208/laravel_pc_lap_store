<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->integer('khMa');
            $table->integer('spMa');
            $table->engine = "InnoDB";

            $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giohang');
    }
}
