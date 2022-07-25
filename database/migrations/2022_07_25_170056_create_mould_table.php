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
            $table->string('mould_number')->default('');
            $table->string('manufacturer')->default('');
            $table->integer('customer_id');
            $table->string('die_life')->default('');
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
