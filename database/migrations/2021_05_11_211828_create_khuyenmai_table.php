<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhuyenmaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->integer('kmMa')->primary();
            $table->string('kmTen')->unique();
            $table->text('kmMota');
            $table->integer('kmTrigia');
            $table->integer('kmTinhtrang');
            $table->timestamp('kmNgaybd');
            $table->timestamp('kmNgaykt');
            $table->integer('kmSoluong')->nullable(true);
            $table->integer('kmGioihanmoikh')->nullable(true);
            $table->integer('kmGiatritoida')->nullable(true);
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
        Schema::dropIfExists('khuyenmai');
    }
}
