<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouldTemplateValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mould_template_value', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('super_customer_id')->nullable();
            $table->bigInteger('mould_template_id')->nullable();
            $table->string('name')->nullable()->comment('计划名称');
            $table->string('admin')->nullable()->comment('负责人');
            $table->integer('play_day')->nullable()->comment('计划时间');
            $table->integer('step_day')->nullable()->comment('按时间完成度');
            $table->integer('step')->nullable()->comment('完成度');

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
        Schema::dropIfExists('mould_template_value');
    }
}
