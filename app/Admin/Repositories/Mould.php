<?php

namespace App\Admin\Repositories;

use App\Models\Mould as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Mould extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
