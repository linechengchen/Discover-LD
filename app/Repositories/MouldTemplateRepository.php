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

namespace App\Repositories;

use App\Models\MouldModel;
use App\Models\MouldTemplateModel;
use App\Traits\HasSelectLoadData;
use Yxx\LaravelQuick\Repositories\BaseRepository;

class MouldTemplateRepository extends BaseRepository
{
    use HasSelectLoadData;

    /**
     * @param string $column
     * @param string $key
     * @return Collection|\Illuminate\Support\Collection
     */
    public static function pluck(string $column, string $key)
    {
        $result = MouldTemplateModel::pluck($column, $key);
        $result=$result->toArray();


        return $res;
    }

    /**
     * @param int MouldType
     * @return MouldTypeRepository
     */
    public function getMouldTypeId(int $mould_id): self
    {
        $product = MouldModel::findOrFail($mould_id);
        $this->textid_array = collect([$product->unit->toArray()]);
        return $this;
    }
}
