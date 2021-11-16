<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaohanhLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baohanh_logs', function (Blueprint $table) {
            $table->id('bhMa');
            $table->char('serial',20);
            $table->timestamp('bhNgay');
            $table->text('bhNoidung');
            $table->integer('bhTinhtrang')->default(0);
            $table->timestamp('bhNgaytra')->nullable();
            $table->integer('khMa');
            $table->char('bhSdt',11);

            $table->engine = "InnoDB";
            $table->foreign('khMa')->references('khMa')->on('khachhang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baohanh_logs');
    }
}
