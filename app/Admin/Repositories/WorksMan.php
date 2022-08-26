<?php

namespace App\Admin\Repositories;

use Admin;
use App\Models\WorksManModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class WorksMan extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

}
