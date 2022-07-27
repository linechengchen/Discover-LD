<?php

namespace App\Admin\Repositories;

use App\Models\SuperAdminMenuModels as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SuperAdminMenu extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
