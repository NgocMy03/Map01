<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->tinyInteger('gioitinh');
            $table->date('namsinh');
            $table->enum('chucvu',['Nhân viên bán hàng','Thu ngân','Quản lý cửa hàng'])->default('Nhân viên bán hàng');
            $table->float('thoigianlamviec');
            $table->foreignId('store_id')->constrained('stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
