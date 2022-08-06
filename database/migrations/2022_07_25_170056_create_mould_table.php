<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMouldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mould', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->default('');
            $table->integer('mould_type_id');
            $table->string('mould_no')->default('');
            $table->string('manufacturer')->default('');
            $table->integer('customer_id');
            $table->bigInteger('early_warning_mode')->nullable()->comment('预警方式');
            $table->string('die_life')->default('')->comment('理论寿命');
            $table->bigInteger('super_customer_id')->nullable();
            $table->bigInteger('type')->nullable()->default(1)->comment('1可用模具，2设计模具');
            $table->bigInteger('mould_template_id')->nullable()->comment('模板id');
            $table->bigInteger('lower_limit')->comment('库存下限');
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
        Schema::dropIfExists('mould');
    }
}
