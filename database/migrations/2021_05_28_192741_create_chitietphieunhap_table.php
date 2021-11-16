<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietphieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieunhap', function (Blueprint $table) {
            $table->integer('ctpnSoluong');
            $table->float('ctpnDongia',20,2);
            $table->float('ctpnThanhtien',20,2);
            $table->integer('spMa');
            $table->integer('nccMa');
            $table->integer('pnMa');
            $table->char('serMa');
                
            $table->engine = "InnoDB";
            
            //foreign key
            $table->foreign('pnMa')->references('pnMa')->on('phieunhap')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('spMa')->references('spMa')->on('sanpham')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nccMa')->references('nccMa')->on('nhacungcap')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
