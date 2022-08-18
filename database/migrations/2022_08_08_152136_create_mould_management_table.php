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
            $table->integer('mould_type_id')->nullable()->comment('模具类型');
            $table->string('mould_management_no')->nullable()->comment('模具编号');
            $table->integer('status')->default(1)->comment('模具状态1使用中2闲置中3维修中4已报废');
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
    }
}
