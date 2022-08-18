<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->integer('work_shop_id');
            $table->date('restday');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('work_shop', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->string('name')->comment('车间名字');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('work_shop_value', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->integer('work_shop_id');
            $table->string('name')->comment('名字');
            $table->string('start')->comment('开始时间');
            $table->string('end')->comment('结束时间');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team');
        Schema::dropIfExists('work_shop');
        Schema::dropIfExists('work_shop_value');
    }
}
