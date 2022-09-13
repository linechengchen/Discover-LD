<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldManagementMakeValueModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;


    protected $table = 'mould_management_make_value';
    public  function mould_management_make(){
        return  $this->belongsTo(MouldManagementMakeModel::class);
    }
}
