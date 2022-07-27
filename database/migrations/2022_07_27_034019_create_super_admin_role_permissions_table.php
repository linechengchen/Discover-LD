<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_role_permissions', function (Blueprint $table) {
            $table->bigInteger('role_id');
            $table->bigInteger('permission_id');
            $table->unique(['role_id', 'permission_id']);
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
        Schema::dropIfExists('super_admin_role_permissions');
    }
}
