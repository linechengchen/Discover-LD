<?php

namespace App\Admin\Repositories;

use App\Models\BaseModel;
use App\Models\MouldManagementMakeModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MouldManagementMakeValue extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */

    protected $eloquentClass = Model::class;
}
