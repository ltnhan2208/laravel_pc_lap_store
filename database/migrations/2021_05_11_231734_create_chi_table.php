<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi', function (Blueprint $table) {
            $table->integer('chiMa')->increments()->primary();
            $table->timestamp('chiNgaylap');
            $table->timestamp('chiNgaybd');
            $table->timestamp('chiNgaykt');
            $table->integer('chiSoluong');
            $table->integer('chiTongtien');
            $table->text('chiGhichu')->nullable();
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
        Schema::dropIfExists('chi');
    }
}
