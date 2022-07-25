<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MouldController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Mould(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('mould_type_id');
            $grid->column('mould_number');
            $grid->column('manufacturer');
            $grid->column('customer_id');
            $grid->column('die_life');
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
        return Show::make($id, new Mould(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('mould_type_id');
            $show->field('mould_number');
            $show->field('manufacturer');
            $show->field('customer_id');
            $show->field('die_life');
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
        return Form::make(new Mould(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('mould_type_id');
            $form->text('mould_number');
            $form->text('manufacturer');
            $form->text('customer_id');
            $form->text('die_life');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
