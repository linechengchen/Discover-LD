<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;

class MouldDesignScheduleModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'mould_design_schedule';
    protected $casts=['complete_date'=>'datetime:Y-m-d H:i','start_date'=>'datetime:Y-m-d H:i'];


}
