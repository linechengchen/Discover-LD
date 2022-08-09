<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouldDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mould_design', function (Blueprint $table) {
            $table->id();
            $table->integer('super_customer_id')->nullable();
            $table->integer('mould_template_id')->nullable();
            $table->integer('mould_id')->nullable()->comment('模具档案id');
            $table->string('schedule')->nullable()->comment('进度');
            $table->string('schedule_type')->nullable()->comment('进度类型');

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
        Schema::dropIfExists('mould_design');
    }
}
