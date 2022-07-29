<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('员工名称');
            $table->string('phone')->default('')->comment('电话号码');
            $table->string('address')->default('')->comment('地址');
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
        Schema::dropIfExists('salesman');
    }
}
