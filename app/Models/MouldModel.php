<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    const TYPE_COMPLETE = 1;
    const TYPE_DESIGN = 2;

    const TYPE=[
        self::TYPE_DESIGN=> '设计模具',
        self::TYPE_COMPLETE=> '成品模具',
    ];


    protected $table = 'mould';
    protected $with = ['mould_type','customer','mould_template','mould_design'];

    public function mould_type():BelongsTo{
        return  $this->belongsTo(MouldTypeModel::class);
    }
    public function mould_design(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return  $this->hasOne(MouldDesignModel::class,'mould_id','id');
    }
    public function mould_template():BelongsTo{
        return  $this->belongsTo(MouldTemplateModel::class);
    }
    public function customer():BelongsTo{
        return  $this->belongsTo(CustomerModel::class);
    }
}
