<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldManagementMakeModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;


    protected $table = 'mould_management_make';
    public  function mould_management_make_value(){
        return  $this->hasMany(MouldManagementMakeValueModel::class,'mould_management_make_id');
    }
}
