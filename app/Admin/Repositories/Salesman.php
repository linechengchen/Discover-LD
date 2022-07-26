<?php

namespace App\Admin\Repositories;

use App\Models\SalesmanModel as Model;
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
