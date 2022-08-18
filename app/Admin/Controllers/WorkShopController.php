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

use App\Admin\Actions\Grid\BatchCreateProSave;
use App\Admin\Repositories\Product;
use App\Admin\Repositories\WorkShop;
use App\Models\AttrModel;
use App\Models\ProductModel;
use App\Repositories\ProductRepository;
use App\Repositories\UnitRepository;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class WorkShopController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new WorkShop(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('type');

            $grid->showColumnSelector();
            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    /**
     * @return Grid
     */
    public function iFrameGrid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            $grid->model()->whereHas('sku');
            $grid->column('id')->sortable();
            $grid->column('item_no');
            $grid->column('name');
            $grid->column('py_code');
            $grid->column('type', '类型')->using(ProductModel::TYPE);
            $grid->column('unit.name', '单位')->emp();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->disableCreateButton();
            $grid->disableActions();

            $grid->tools(BatchCreateProSave::make());

            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new WorkShop('values'), function (Form $form) {

            $form->text('name','车间')->required();
            $form->hidden('super_customer_id')->default(\Admin::user()->id);
            $form->hasMany('values', '班次信息', function (Form\NestedForm $table) {
                $table->text('name', '班次名称')->required();
                $table->timeRange('start','end', '工作时间')->required();
                $table->text('remark', '备注');
                $table->hidden('super_customer_id')->default(\Admin::user()->id);
            })->useTable();
            $form->saving(function (Form $form) {

            });

        });
    }
}
