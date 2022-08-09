<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MouldDesignScheduleModel extends BaseModel
{
	use HasDateTimeFormatter;
    use SoftDeletes;


    protected $table = 'mould_design_schedule';

}
