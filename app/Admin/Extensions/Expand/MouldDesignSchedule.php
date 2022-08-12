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
use Carbon\Carbon;
use Dcat\Admin\Admin;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use Faker\Provider\Base;

class MouldDesignSchedule extends LazyRenderable
{

    public function render()
    {
        Admin::script($this->script());
        $attribute_id = $this->key;
        $mould_design = MouldDesignModel::find($this->key);

        $attributes = MouldDesignScheduleModel::where('mould_design_id', $attribute_id)->get();
        if (empty($mould)) {
            if ($mould_design->schedule_type == BaseModel::SCHEDULE_TYPE_STANDARD_INTERVAL) {
                $data = $attributes->map(function (MouldDesignScheduleModel $attributeValueModel, $key) {
                    $show = empty($attributeValueModel->start_date) ? "1" : "2";
                    if (!empty($attributeValueModel->start_date)) {
                        if (!empty($attributeValueModel->complete_date)) {

                            $show = '3';
                        }

                    }
                    return [
                        'id' => $key + 1,
                        'name' => $attributeValueModel->name,
                        'admin' => $attributeValueModel->admin,
                        'play_day' => $attributeValueModel->play_day . "天",
                        'step_day' => $attributeValueModel->step_day . "%",
                        'start_date' => empty($attributeValueModel->start_date) ? "未开始" : $attributeValueModel->start_date,
                        'plane_time' => empty($attributeValueModel->start_date) ? "" : Carbon::create($attributeValueModel->start_date)->addDay($attributeValueModel->play_day),
                        'complete_date' => empty($attributeValueModel->complete_date) ? "未完成" : $attributeValueModel->complete_date,
                        'remark' => $attributeValueModel->remark,
                        "<a class='edit-apply-of-order' data-show-btn='{$show}'      href='javascript:void(0)' data-action=" . admin_route('mould-design-schedule.edit', [$attributeValueModel->id]) . ">操作</a>",
                    ];
                })->toArray();

                $titles = [
                    '序号',
                    '计划名称',
                    '负责人',
                    '预计日期',
                    '按时间预计完成度',
                    '开始时间',
                    '预计完成时间',
                    '完成时间',
                    '备注',
                    '操作',
                ];
            } else {
                $data = $attributes->map(function (MouldDesignScheduleModel $attributeValueModel, $key) {
                    $show = empty($attributeValueModel->start_date) ? "1" : "2";
                    if (!empty($attributeValueModel->start_date)) {
                        if (!empty($attributeValueModel->complete_date)) {

                            $show = '3';
                        }

                    }
                    return [
                        'id' => $key + 1,
                        'name' => $attributeValueModel->name,
                        'admin' => $attributeValueModel->admin,
                        'play_day' => $attributeValueModel->play_day . "天",
                        'step' => $attributeValueModel->step . "%",
                        'start_date' => empty($attributeValueModel->start_date) ? "未开始" : $attributeValueModel->start_date,
                        'plane_time' => empty($attributeValueModel->start_date) ? "" : Carbon::create($attributeValueModel->start_date)->addDay($attributeValueModel->play_day),
                        'complete_date' => empty($attributeValueModel->complete_date) ? "未完成" : $attributeValueModel->complete_date,
                        'remark' => $attributeValueModel->remark,
                        "<a class='edit-apply-of-order' data-show-btn='{$show}'      href='javascript:void(0)' data-action=" . admin_route('mould-design-schedule.edit', [$attributeValueModel->id]) . ">操作</a>",
                    ];
                })->toArray();

                $titles = [
                    '序号',
                    '计划名称',
                    '负责人',
                    '预计日期',
                    '按计划预计完成度',
                    '开始时间',
                    '预计完成时间',
                    '完成时间',
                    '备注',
                    '操作',
                ];
            }
        }

        return Table::make($titles, $data);
    }

    public function script()
    {
        return <<<'JS'
        $(".edit-apply-of-order").on("click",function(){
               var action = $(this).data('action');
            var show_btn = $(this).data('show-btn');
            var status = $(this).data('status');
            console.log(status)
            var title = '模具设计操作';
            var option = {
                title:title,
                type: 2,
                area: ['75%', '60%'], //宽高
                content:[action],
                scrollbar:false,
                // maxmin:true,
                end: function(){
                    if (show_btn == "yes") {
                        Dcat.reload();
                    }
                },
            };
            if (show_btn==1){
                                option.btn = ['开始设计'];
   option.btn1 = function(index, layero){
                    var orderInfo = $('#layui-layer-iframe'+index).contents().find('.content .row:eq(0) .col-md-12:eq(0) form:eq(0)');
                    console.log(orderInfo.serialize())
                    var url = orderInfo.attr('action');
                    var data=orderInfo.serialize()
                    data="type=1&"+data
                    Dcat.NP.start();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url ,//url
                        data: data,
                        success: function (data) {
                            if (data.status) {
                                Dcat.success("设计开始");
                                Dcat.reload();
                            } else {
                                Dcat.error(data.message);
                            }
                        },
                        error : function(a,b,c) {
                            Dcat.handleAjaxError(a, b, c);
                        },
                        complete:function(a,b) {
                            Dcat.NP.done();
                        }
                    });
                    layer.close(index);
                };
            }
            if (show_btn==2){
                                option.btn = ['完成设计'];
   option.btn1 = function(index, layero){
                    var orderInfo = $('#layui-layer-iframe'+index).contents().find('.content .row:eq(0) .col-md-12:eq(0) form:eq(0)');
                    console.log(orderInfo.serialize())
                    var url = orderInfo.attr('action');
                    var data=orderInfo.serialize()
                    data="type=2&"+data
                    Dcat.NP.start();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url ,//url
                        data: data,
                        success: function (data) {
                            if (data.status) {
                                Dcat.success("设计完成");
                                        Dcat.reload();
                            } else {
                                Dcat.error(data.message);
                            }
                        },
                        error : function(a,b,c) {
                            Dcat.handleAjaxError(a, b, c);
                        },
                        complete:function(a,b) {
                            Dcat.NP.done();
                        }
                    });
                    layer.close(index);
                };
            }
 if (show_btn==3){
                                option.btn = ['关闭'];
   option.btn1 = function(index, layero){
                    var orderInfo = $('#layui-layer-iframe'+index).contents().find('.content .row:eq(0) .col-md-12:eq(0) form:eq(0)');
                    console.log(orderInfo.serialize())
                    var url = orderInfo.attr('action');
                    var data=orderInfo.serialize()
                     $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url ,//url
                        data: data,
                        success: function (data) {
                            if (data.status) {
                                Dcat.success("已关闭");
                                Dcat.reload();
                            } else {
                                Dcat.error(data.message);
                            }
                        },
                        error : function(a,b,c) {
                            Dcat.handleAjaxError(a, b, c);
                        },
                        complete:function(a,b) {
                            Dcat.NP.done();
                        }
                    });
                    layer.close(index);
                };
            }
            layer.open(option)
        });
JS;
    }
}
