<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use App\Models\CustomerModel;
use App\Repositories\CustomerRepository;
use App\Repositories\MouldRepository;
use App\Repositories\MouldTypeRepository;
use App\Admin\Forms\SelfForm as Form;
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
            $grid->column('mould_type.name','模具类型');
            $grid->column('mould_no');
            $grid->column('manufacturer');
            $grid->column('customer.name','模具归属');
            $grid->column('die_life');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->showColumnSelector();
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
            $form->row(function (Form\Row $row) use ($form) {
                $form->hidden('super_customer_id')->default(\Admin::user()->id);
                $row->width(6)->text('mould_no')
                    ->default(MouldRepository::buildMouldNo())
                    ->creationRules(['unique:mould'])
                    ->updateRules(['unique:mould,mould_no,{{id}}'])
                    ->help('模具档案唯一编号')
                    ->required();
                $row->width(6)->text('name')->required();

            });
            $form->row(function (Form\Row $row) use ($form) {
                $types = MouldTypeRepository::pluck('name', 'id');

                $row->width(6)
                    ->select('mould_type_id', '单位')
                    ->options($types)
                    ->default(head($types->keys()->toArray()) ?? '')
                    ->required();
                $row->width(6)->text('manufacturer');

            });
            $form->row(function (Form\Row $row) use ($form) {
                $customers = CustomerRepository::pluck('name', 'id');

                $row->width(6)
                    ->select('customer_id', '模具归属客户')
                    ->options($customers)
                    ->default(head($customers->keys()->toArray()) ?? '')
                    ->help('非客户,请添加自己公司')
                    ->required();
                $row->width(6)->text('die_life')->required();

            });


            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
