<?php

namespace App\SuperModels;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SuperAdminRolePermissionsModel extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'super_admin_role_permissions';

}
