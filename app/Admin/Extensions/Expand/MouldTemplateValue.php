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

namespace App\Admin\Extensions\Expand;

use App\Models\AttrValueModel;
use App\Models\MouldTemplateValueModel;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;

class MouldTemplateValue extends LazyRenderable
{
    public function render()
    {
        $attribute_id = $this->key;
        $attributes = MouldTemplateValueModel::where('mould_template_id', $attribute_id)->get(['id','name','admin','play_day','step']);
        $data = $attributes->map(function (MouldTemplateValueModel $attributeValueModel, $key) {
            return [
                'id' => $key + 1,
                'name' => $attributeValueModel->name,
                'admin' => $attributeValueModel->admin,
                'play_day' => $attributeValueModel->play_day."天",
                'step' => $attributeValueModel->step."%",
            ];
        })->toArray();
        $titles = [
            '序号',
            '计划名称',
            '负责人',
            '预计日期',
            '预计完成度',
        ];
        return Table::make($titles, $data);
    }
}
