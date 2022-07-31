<?php

namespace App\Admin\Controllers;

use Admin;
use App\Admin\Forms\SelfForm;
use App\Admin\Repositories\Salesman;
use App\Admin\Forms\SelfForm as Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Log;

class SalesmanController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(self(new Salesman()), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('phone');
            $grid->column('address');
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
        return Show::make($id, new Salesman(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('phone');
            $show->field('address');
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
        return Form::make(new Salesman(), function (SelfForm $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->mobile('phone')->required();
            $form->text('address');

            $form->display('created_at');
            $form->display('updated_at');

        });
    }
}
