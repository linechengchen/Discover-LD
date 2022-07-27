<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50)->nullable();
            $table->string('uri', 50)->nullable();
            $table->tinyInteger('show')->default(1);
            $table->string('extension', 50)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_admin_menu');
    }
}
