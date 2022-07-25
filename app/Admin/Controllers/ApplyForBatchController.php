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

use App\Admin\Actions\Grid\BatchStockSelect;
use App\Admin\Actions\Grid\Delete;
use App\Admin\Repositories\ApplyForBatch;
use App\Models\ApplyForItemModel;
use App\Models\ApplyForOrderModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class ApplyForBatchController extends AdminController
{
    protected function iFrameGrid()
    {
        $order = ApplyForItemModel::query()->findOrFail(request()->input('item_id'))->order;
        return Grid::make(new ApplyForBatch(['item.sku.product', 'stock_batch']), function (Grid $grid) use ($order) {
            $grid->model()->where('item_id', request()->input('item_id'))->orderBy('id', 'desc');
            $grid->column('id')->sortable();
            $grid->column('item.sku.product.name', '产品名称');
            $grid->column('item.sku.product.unit.name', '单位');
            $grid->column('item.sku.product.type_str', '类型');
            $grid->column('item.sku.product.type_str', '类型');
            $grid->column('item.sku.attr_value_ids_str', '属性');
            $grid->column('stock_batch.standard_str', '检验标准');
            $grid->column('stock_batch.batch_no');
            $grid->column('actual_num', '实领数量')->if(function () use ($order) {
                return $order->review_status !== ApplyForOrderModel::REVIEW_STATUS_OK;
            })->edit();

            $grid->column('stock_batch.cost_price', '成本价格');
            $grid->column('stock_batch.batch_no', '批次');
            $grid->column('stock_batch.position.name', '库位');
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->tools(Delete::make());

            if ($order->review_status !== ApplyForOrderModel::REVIEW_STATUS_OK) {
                $grid->tools(BatchStockSelect::make());
            }
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
        return Form::make(new ApplyForBatch(), function (Form $form) {
            $form->decimal('actual_num');
        });
    }
}
