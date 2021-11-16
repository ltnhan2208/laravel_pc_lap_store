<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integer('adMa')->primary();
            $table->string('adTen',50)->unique();
            $table->char('adTaikhoan',50)->unique();
            $table->char('adMatkhau',50);
            $table->char('adEmail',50)->unique();
            $table->char('adSdt',11)->unique();
            $table->char('adHinh',50)->nullable(true);
            $table->char('adHinhcmnd',50)->unique()->default('x');
            $table->string('adDiachi',50);
            $table->integer('adQuyen');
            $table->integer('adTinhtrang');
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
        Schema::dropIfExists('admin');
    }
}
