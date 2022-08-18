<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('work_no')->comment('员工编号');
            $table->string('name')->default('')->comment('员工名称');
            $table->string('phone')->default('')->comment('电话号码');
            $table->integer('type')->default('1销售人员2工作人员')->comment('员工类型');
            $table->integer('status')->default('1在职2离职')->comment('员工状态');
            $table->string('address')->default('')->comment('地址')->nullable();
            $table->bigInteger('super_customer_id')->nullable();

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
        Schema::dropIfExists('worksman');
    }
}
