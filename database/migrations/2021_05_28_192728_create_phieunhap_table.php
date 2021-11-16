<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('phieunhap', function (Blueprint $table) {
            $table->integer('pnMa')->autoIncrement();
            $table->timestamp('pnNgaylap');
            $table->integer('pnSoluongsp');
            $table->float('pnTongtien',20,2);
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
        //
    }
}
