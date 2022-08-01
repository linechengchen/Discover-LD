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

namespace App\Admin\Controllers;

use App\Admin\Extensions\Expand\AttrValue;
use App\Admin\Extensions\Expand\MouldTemplateValue;
use App\Admin\Repositories\Attr;
use App\Admin\Repositories\MouldTemplate;
use App\Models\MouldTemplateValueModel;
use App\Models\MouldTypeModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class MouldTemplateController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MouldTemplate(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('value', '模板详情')
                ->display('查看')
                ->expand(MouldTemplateValue::class);
            $grid->column('created_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new MouldTemplate('values'), function (Form $form) {
            $form->text('name')->help('模板名称')->required();
            $form->hidden('super_customer_id')->default(\Admin::user()->id);
            $form->hasMany('values', '属性值', function (Form\NestedForm $table) {
                $table->text('name', '计划名称')->required();
                $table->text('admin', '负责人')->help('负责人姓名')->required();
                $table->text('play_day', '预计日期')->help('输入天数')->required();
                $table->text('step', '预计完成度')->help('例如30%输入30')->required();
                $table->hidden('super_customer_id')->default(\Admin::user()->id);
                $table->hidden('step_day');
            })->useTable();
            $form->saving(function (Form $form) {
                $val = 0;
                $valday = 0;
                foreach ($form->values as $value) {
                    if ($value['_remove_'] != 1) {
                        $val=$val+$value['step'];
                        $valday=$val+$value['play_day'];

                    }
                }
                if($val!=100){
                    return $form->response()->error('完成百分比综合必须  等于100,-现在是：'.$val);
                }
                if($valday<=0){
                    return $form->response()->error('预计日期总和不能为小于等于0,-现在是：'.$valday);
                }
            });
            $form->saved(function (Form $form,$result) {
                $count_day=MouldTemplateValueModel::where('mould_template_id',$result)->sum('play_day');
                $model=MouldTemplateValueModel::where('mould_template_id',$result)->get();
                foreach ($model as $item) {
                   $item->step_day=100/($count_day/ $item->play_day);
                   $item->save();
                }
            });
        });

    }
}
