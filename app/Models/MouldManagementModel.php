<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldManagementModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    const STATUS_IDLE = 1;
    const STATUS_IN_USE = 2;
    const STATUS_REPAIR = 3;
    const STATUS_SCRAPPED = 4;
    const STATUS = [
        self::STATUS_IDLE => '闲置中',
        self::STATUS_IN_USE => '使用中',
        self::STATUS_REPAIR => '维修中',
        self::STATUS_SCRAPPED => '已报废',

    ];
    protected $table = 'mould_management';
    public  function mould(){
        return  $this->belongsTo(MouldModel::class);
    }
}
