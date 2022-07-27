<?php

namespace App\Admin\Repositories;

use App\Models\SuperAdminRolePermissionsModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SuperAdminRolePermissions extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
