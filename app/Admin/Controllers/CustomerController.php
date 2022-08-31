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

use App\Admin\Actions\Grid\Statement;
use App\Admin\Repositories\Customer;
use App\Models\CustomerModel;
use App\Models\RoleUsersModel;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Models\Role;

class CustomerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Customer('admin_users'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('pay_method')->using(CustomerModel::PAY);
            $grid->column('admin_users.name','客户归属');
            $grid->column('phone');
            $grid->column('created_at');
            $grid->filter(function (Grid\Filter $filter) {
            });
        });
    }

    protected function iFrameGrid()
    {
        return Grid::make(new Customer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('link')->emp();
            $grid->column('name')->emp();
            $grid->column('other')->emp();
            $grid->column('pay_method')->using(CustomerModel::PAY);
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
        return Form::make(new Customer(['drawee', 'address']), function (Form $form) {
            $form->text('link')->required();
            $form->text('name')->required();
            $form->text('other');
            $form->select('pay_method')->options(CustomerModel::PAY)->default(0)->required();
            $form->mobile('phone')->required();
//            Admin::where('super_customer_id',);
           $ids= RoleUsersModel::where('role_id','2')->where('super_customer_id',Admin::user()->super_customer_id)->pluck('user_id');
            $admin=Administrator::whereIn('id',$ids)->pluck('name','id');

            $form->select('admin_users_id','客户归属')->options($admin);
//            $form->multipleSelect('drawee', '付款人')->options($form->repository()->drawee())->customFormat(function (array $v) {
//                return array_column($v, 'id');
//            });
            $form->hasMany('address', '客户地址', function (Form\NestedForm $form) {
                $form->text('address', '地址')->required();
//                $form->text('other')->default('')->saveAsString();
            })->useTable();
        });
    }
}
