<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use App\Admin\Repositories\MouldTemplate;
use App\Models\BaseModel;
use App\Models\CustomerModel;
use App\Models\MouldDesignModel;
use App\Models\MouldDesignScheduleModel;
use App\Models\MouldTemplateModel;
use App\Models\MouldTemplateValueModel;
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
            $grid->column('mould_template.name', '模具模板');
            $grid->column('schedule_type')->using(BaseModel::SCHEDULE_TYPE);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->showColumnSelector();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name')->width(4);
                $filter->like('mould_no')->width(4);
                $filter->like('manufacturer')->width(4);
                $filter->equal('type')->width(6)->radio(MouldTemplateModel::TYPE);
                $filter->equal('early_warning_mode')->width(6)->radio(MouldTemplateModel::EARLY_WARNING_MODE);

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
                $row->width(6)->text('name')->required()->creationRules(['required','unique:mould']);


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
                $row->width(6)->number('die_life', '理论寿命')
                    ->help('无预警可空');

            });
            if ($form->isCreating()) {
                $form->row(function (Form\Row $row) use ($form) {
                    $result = MouldTemplateModel::pluck('name', 'id');
                    $result[0] = '无需模板';
                    $row->width(6)->radio('type', '模具状态')
                        ->options(['1' => '成品模具', '模具设计'])
                        ->default('1');
                    $row->width(6)->radio('schedule_type', '进度类型')
                        ->options([0 => "无需选择", '1' => "标准间隔时间", 2 => "计划完成时间"])
                        ->default(0)
                        ->help('成品模具，无需选择');
                    $row->width(6)->select('mould_template_id', '模板选择')
                        ->options($result)
                        ->default(0)
                        ->help('成品模具，无需选择');
                });
                $form->saving(function (Form $form) {
                    if ($form->type > 1) {
                        if ($form->schedule_type < 1 or $form->mould_template_id < 1) {
                            return $form->response()->error('模具状态为模具设计,必须选择模具模板与进度类型');
                        }
                    }

                });
                $form->saved(function (Form $form, $result) {
                    $moulddesign = MouldDesignModel::create([
                        'super_customer_id'=>$form->super_customer_id,
                        'mould_template_id' => $form->mould_template_id,
                        'mould_id' => $result,
                        'schedule' => 0,
                        'schedule_type' => $form->schedule_type,
                    ]);
                   $MT= MouldTemplateValueModel::where('mould_template_id',$form->mould_template_id)->get();
                    foreach ($MT as $item) {

                        $moulddesignschedule = MouldDesignScheduleModel::create([
                            'super_customer_id'=>$form->super_customer_id,
                            'mould_template_id' => $form->mould_template_id,
                            'mould_design_id' => $moulddesign->id,
                            'name' => $item->name,
                            'admin' => $item->admin,
                            'play_day' => $item->play_day,
                            'step_day' => $item->step_day,
                            'step' => $item->step,
                            'type' => $form->schedule_type,
                        ]);
                    }

                });
            }


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
