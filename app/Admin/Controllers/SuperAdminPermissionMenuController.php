<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SuperAdminPermissionMenu;
use App\Admin\Forms\SelfForm as Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SuperAdminPermissionMenuController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SuperAdminPermissionMenu(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('ddd');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new SuperAdminPermissionMenu(), function (Show $show) {
            $show->field('id');
            $show->field('ddd');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SuperAdminPermissionMenu(), function (Form $form) {
            $form->display('id');
            $form->text('ddd');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
