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
use App\Models\BaseModel;
use App\Models\MouldDesignModel;
use App\Models\MouldDesignScheduleModel;
use App\Models\MouldTemplateValueModel;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use Faker\Provider\Base;

class MouldDesignSchedule extends LazyRenderable
{
    public function render()
    {
        $attribute_id = $this->key;
        $mould_design =MouldDesignModel::find($this->key);

        $attributes = MouldDesignScheduleModel::where('mould_design_id', $mould_design->mould_id)->get(['id','name','admin','play_day','step_day','step']);
       if(empty($mould)) {
           if (empty($attributes[0]->schedule_type == BaseModel::SCHEDULE_TYPE_STANDARD_INTERVAL)) {
               $data = $attributes->map(function (MouldDesignScheduleModel $attributeValueModel, $key) {
                   return [
                       'id' => $key + 1,
                       'name' => $attributeValueModel->name,
                       'admin' => $attributeValueModel->admin,
                       'play_day' => $attributeValueModel->play_day . "天",
                       'step_day' => $attributeValueModel->step_day . "%",
                       'step' => $attributeValueModel->step . "%",
                   ];
               })->toArray();
               $titles = [
                   '序号',
                   '计划名称',
                   '负责人',
                   '预计日期',
                   '按时间预计完成度',
                   '预计完成度',
               ];
           } else {
               $data = $attributes->map(function (MouldDesignScheduleModel $attributeValueModel, $key) {
                   return [
                       'id' => $key + 1,
                       'name' => $attributeValueModel->name,
                       'admin' => $attributeValueModel->admin,
                       'play_day' => $attributeValueModel->play_day . "天",
                       'step_day' => $attributeValueModel->step_day . "%",
                       'step' => $attributeValueModel->step . "%",
                   ];
               })->toArray();
               $titles = [
                   '序号',
                   '计划名称',
                   '负责人',
                   '预计日期',
                   '按时间预计完成度',
                   '预计完成度',
               ];
           }
       }

        return Table::make($titles, $data);
    }
}
