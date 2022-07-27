<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminPermissionMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_permission_menu', function (Blueprint $table) {
            $table->bigInteger('permission_id');
            $table->bigInteger('menu_id');
            $table->unique(['permission_id', 'menu_id']);
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
        Schema::dropIfExists('super_admin_permission_menu');
    }
}
