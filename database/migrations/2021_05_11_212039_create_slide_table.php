<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide', function (Blueprint $table) {
            $table->id('bnMa');
            $table->string('bnTieude');
            $table->longtext('bnNoidung')->nullable(true);;
            $table->char('bnHinh',50);
            $table->timestamp('bnNgay');
            $table->integer('bnVitri');
            $table->integer('bnTrang');
            $table->integer('bnTrangthai');
  
            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
}
