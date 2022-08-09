<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouldDesignScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mould_design_schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->integer('mould_template_id')->nullable();
            $table->integer('mould_design_id')->nullable()->comment('模具设计id');
            $table->string('name')->nullable()->comment('计划名称');
            $table->string('admin')->nullable()->comment('负责人');
            $table->integer('play_day')->nullable()->comment('计划时间');
            $table->integer('step_day')->nullable()->comment('按时间完成度');
            $table->integer('step')->nullable()->comment('完成度');
            $table->integer('state')->nullable()->comment('状态1未完成2 已完成')->default(1);
            $table->integer('type')->nullable()->comment('类型')->default(1);

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
        Schema::dropIfExists('mould_design_schedule');
    }
}
