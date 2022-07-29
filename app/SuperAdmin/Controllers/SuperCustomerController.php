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

namespace App\SuperAdmin\Controllers;

use App\Admin\Actions\Grid\Statement;
use App\SuperAdmin\Repositories\SuperCustomer;
use Database\Seeders\InsertSuperCustomer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class SuperCustomerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SuperCustomer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('phone');
            $grid->column('created_at');
            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    protected function iFrameGrid()
    {
        return Grid::make(new SuperCustomer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('phone');
            $grid->column('created_at');
            $grid->tools(Statement::make());
            $grid->disableCreateButton();
            $grid->disableActions();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SuperCustomer(), function (Form $form) {
            $form->text('link')->required();
            $form->text('name')->required();
            $form->text('other');
            $form->mobile('phone')->required()
                ->creationRules(['unique:super_customer'])
                ->updateRules(['unique:super_customer,phone,{{id}}'])
                ->help('客户超级管理员登录账号')
                ->required();;
            $form->saved(function (Form $form, $result) {
               (new \App\SuperAdmin\Repositories\SuperCustomer)->InsertSuperCustomer($form);
            });
        });
    }
}
