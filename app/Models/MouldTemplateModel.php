<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class MouldTemplateModel extends BaseModel
{
    use SoftDeletes;

    const NONE = 0;
    const NUM = 1;
    const TIME = 2;
    const EARLY_WARNING_MODE = [
        self::NONE => '无预警',
        self::NUM => '计次',
        self::TIME => '计时(天)',
    ];

    const OK = 1;
    const DESIGN = 2;
    const TYPE = [
        self::OK => '成品模具',
        self::DESIGN => '模具设计',
    ];
    protected $table = 'mould_template';

    public function values():HasMany
    {
        return $this->hasMany(MouldTemplateValueModel::class, 'mould_template_id');
    }
}
