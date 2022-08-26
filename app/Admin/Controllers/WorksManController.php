<?php

namespace App\Admin\Controllers;

use Admin;
use App\Admin\Forms\SelfForm;
use App\Admin\Repositories\WorksMan;
use App\Admin\Forms\SelfForm as Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Log;

class WorksManController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new WorksMan(), function (Grid $grid) {
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
        return Show::make($id, new WorksMan(), function (Show $show) {
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
        return Form::make(new WorksMan(), function (SelfForm $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->mobile('phone')->required();
            $form->text('address');

            $form->display('created_at');
            $form->display('updated_at');

        });
    }
}
