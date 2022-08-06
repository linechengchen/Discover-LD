<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use App\Admin\Repositories\MouldTemplate;
use App\Models\CustomerModel;
use App\Models\MouldTemplateModel;
use App\Models\MouldTypeModel;
use App\Repositories\CustomerRepository;
use App\Repositories\MouldRepository;
use App\Repositories\MouldTypeRepository;
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
            $grid->column('mould_type.name', '模具类型');
            $grid->column('mould_no');
            $grid->column('manufacturer');
            $grid->column('customer.name', '模具归属');
            $grid->column('die_life');
            $grid->column('early_warning_mode')->using(MouldTemplateModel::EARLY_WARNING_MODE);;
            $grid->column('type')->using(MouldTemplateModel::TYPE);
            $grid->column('mould_template.name','模具模板');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->showColumnSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('type')->width(4)->radio(MouldTemplateModel::TYPE);
                $filter->equal('early_warning_mode')->width(4)->radio(MouldTemplateModel::EARLY_WARNING_MODE);

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
                    ->select('mould_type_id', '类型')
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
                $row->width(6)->number('lower_limit', '库存下限');
            });

            $form->row(function (Form\Row $row) use ($form) {
                $row->width(6)->select('early_warning_mode', '预警方式')
                    ->options(['1' => '无', '2' => '计次', '3' => '计时(天）'])
                    ->default('1');
                $row->width(6)->number('die_life','理论寿命')
                ->help('无预警可空');

            });
            $form->row(function (Form\Row $row) use ($form) {
                $result = MouldTemplateModel::pluck('name', 'id');
                $result[0]='无需模板';
                $row->width(6)->radio('type', '模具状态')
                    ->options(['1' => '成品模具','模具设计' ])
                    ->default('1');
                $row->width(6)->select('mould_template_id','模板选择')
                    ->options($result)
                    ->default(0)
                    ->help('成品模具，无需选择');

            });

//                $form->select('early_warning_mode', '预警方式')
//                    ->when([2, 3], function (Form\Row $row) use ($form) {
//                        $row->number('die_life','理论寿命');
//                    })
//                    ->options(['无' => '1', '2' => '计次', '3' => '计时(天）'])
//                    ->default('1');
//
//                $row->width(6)->text('die_life')->required();



            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
