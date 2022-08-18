<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldModel extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;


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
