<?php

namespace App\Admin\Repositories;

use App\Models\MouldDesignScheduleModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MouldDesignSchedule extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
