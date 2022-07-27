<?php

namespace App\Admin\Repositories;

use App\Models\SuperAdminPermissionMenuModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SuperAdminPermissionMenu extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
