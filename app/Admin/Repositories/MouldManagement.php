<?php

namespace App\Admin\Repositories;

use App\Models\BaseModel;
use App\Models\MouldManagementModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MouldManagement extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
    public static function buildMouldNo()
    {
        $productId = Model::orderBy('id', 'desc')->value('id') ?? 0;
        return 'MM'.str_pad($productId + 1, 6, "0", STR_PAD_LEFT);
    }
    public static function mould_complete($mould)
    {
        if($mould->type==1){
            return true;
        }

        if($mould->mould_design->sum('schedule')==100){
            return true;
        }
        return false;

    }

}
