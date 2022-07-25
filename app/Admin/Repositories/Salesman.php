<?php

namespace App\Admin\Repositories;

use App\Models\Salesman as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Salesman extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
