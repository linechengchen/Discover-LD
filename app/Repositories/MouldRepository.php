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
use Yxx\LaravelQuick\Repositories\BaseRepository;

class MouldRepository extends BaseRepository
{
    public static function buildMouldNo()
    {
        $productId = MouldModel::orderBy('id', 'desc')->value('id') ?? 0;
        return 'MD'.str_pad($productId + 1, 6, "0", STR_PAD_LEFT);
    }

    /**
     * @param int $product_id
     * @return ProductModel|null
     */
    public function getInfoById(int $product_id): ?ProductModel
    {
        return ProductModel::find($product_id);
    }
}
