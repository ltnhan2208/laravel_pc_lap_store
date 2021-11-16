<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaocaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baocao', function (Blueprint $table) {
            $table->id('bcMa');
            $table->integer('bcTonghangxuat');
            $table->integer('bcTonghangnhap');
            $table->integer('bcThu');
            $table->integer('bcChi');
            $table->integer('bcTonkho');
            $table->timestamp('bcNgaylap');
            $table->timestamp('bcTungay');
            $table->timestamp('bcDenngay');
            $table->string('bcGhichu')->nullable();
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
        Schema::dropIfExists('baocao');
    }
}
