<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhachhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->integer('khMa')->primary();
            $table->string('khTen',50);
            $table->char('khEmail',50)->unique();
            $table->char('khTaikhoan')->unique();
            $table->char('khMatkhau',50);
            $table->date('khNgaysinh');
            $table->integer('khGioitinh');
            $table->string('khDiachi');
            $table->char('khSdt',11)->unique();
            $table->char('khHinh')->nullable(true);
            $table->char('khXtemail')->nullable(true);
            $table->char('khResetpassword')->nullable(true);
            $table->date('khNgaythamgia');
            $table->integer('khQuyen');
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
        Schema::dropIfExists('khachhang');
    }
}
