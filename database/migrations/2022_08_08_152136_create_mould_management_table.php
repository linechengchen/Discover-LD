<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouldManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mould_management', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->integer('mould_id')->nullable()->comment('模具档案id');
            $table->string('mould_management_no')->nullable()->comment('模具编号');
            $table->integer('status')->default(1)->comment('模具状态1使用中2闲置中3维修中4已报废');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('mould_management_make', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->string('name')->unique()->comment('模具组名称');
            $table->string('remark')->comment('模具套件备注')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('mould_management_make_value', function (Blueprint $table) {
            $table->id();
            $table->string('mould_management_make_id')->nullable()->comment('模具组id');
            $table->integer('super_customer_id')->nullable();
            $table->string('mould_id')->nullable()->comment('模具id');
            $table->string('remark')->comment('模具套件备注')->nullable();
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
        Schema::dropIfExists('mould_management');
        Schema::dropIfExists('mould_management_group');
        Schema::dropIfExists('mould_management_group_value');
    }
}
