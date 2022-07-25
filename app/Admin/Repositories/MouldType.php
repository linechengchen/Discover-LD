<?php

namespace App\Admin\Repositories;

use App\Models\MouldType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MouldType extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
