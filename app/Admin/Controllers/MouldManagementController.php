<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use App\Admin\Repositories\MouldDesign;
use App\Admin\Repositories\MouldManagement;
use App\Admin\Repositories\MouldTemplate;
use App\Models\BaseModel;
use App\Models\CustomerModel;
use App\Models\MouldDesignModel;
use App\Models\MouldDesignScheduleModel;
use App\Models\MouldManagementModel;
use App\Models\MouldModel;
use App\Models\MouldTemplateModel;
use App\Models\MouldTemplateValueModel;
use App\Models\MouldTypeModel;
use App\Repositories\CustomerRepository;
use App\Repositories\MouldRepository;
use App\Repositories\MouldTypeRepository;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;
use Overtrue\Pinyin\Pinyin;

class MouldManagementController extends AdminController
{


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MouldManagement('mould'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('mould_management_no');
            $grid->column('mould.name', '模具型号');
            $grid->column('status')->using(MouldManagementModel::STATUS);

//            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();
            $grid->showColumnSelector();

//            $grid->filter(function (Grid\Filter $filter) {
//                $filter->like('name')->width(4);
//                $filter->like('mould_no')->width(4);
//                $filter->like('manufacturer')->width(4);
//                $filter->equal('type')->width(6)->radio(MouldTemplateModel::TYPE);
//                $filter->equal('early_warning_mode')->width(6)->radio(MouldTemplateModel::EARLY_WARNING_MODE);
//
//            });
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

    public function script()
    {
        return <<<JS
        console.log('所有JS脚本都加载完了');
        // 初始化操作写在这里
JS;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new  MouldManagement('mould'), function (Form $form) {


            $form->row(function (Form\Row $row) use ($form) {
                //模具使用不需要编辑模具
                if ($form->isCreating()) {
                    $types = MouldModel::pluck('name', 'id');
                    $row->width(6)
                        ->select('mould_id', '模具')
                        ->options($types)
                        ->default(head($types->keys()->toArray()) ?? '')
                        ->required();
                }
                if ($form->isEditing()) {
                    Admin::script(
                        <<<JS

    console.log({$row->model()->status})
    $('input[name="operation"]').on('change',function() {
      console.log($(this).val())
    })
    $('.layui-layer-title').text('模具操作');
  $('input:hidden[name="operation2"]').parent().parent().parent().hide()
JS
                    );
                    $row->width(6)->text('mould_management_no')->disable();
                    $row->width(6)->text('mould.name', '模具类型')->disable();
                    $row->width(6)->text('', '当前状态')->value(MouldManagementModel::STATUS[$row->model()->status])->disable();
                    $row->divider();

                    //以下代码实现不了
                    $row->html('<h4>模具操作</h4><p>');
                    $row->divider();
//
                    $status = MouldManagementModel::STATUS;
                    unset($status[$row->model()->status]);
                    $row->width(12)->radio('operation', '操作')->options($status);
                    $row->width(12)->radio('operation2', '操作')->options($status);
//                    $row->radio('radio')
//                        ->when([1, 4], function (Form $form) use($row) {
//                            // 值为1和4时显示文本框
//                            $form->text('text1');
//                            $form->text('text2');
//                            $form->text('text3');
//                        })
//                        ->when(2, function (Form $form) {
//                            $form->editor('editor');
//                        })
//                        ->when(3, function (Form $form) {
//                            $form->image('image');
//                        })
//                        ->options([
//                            1 => '显示文本框',
//                            2 => '显示编辑器',
//                            3 => '显示文件上传',
//                            4 => '还是显示文本框',
//                        ])
//                        ->default(1);
                }


            });
            $form->saving(function (Form $form) {
                if (!MouldManagement::mould_complete(MouldModel::find($form->mould_id))) {
                    return $form->response()->error('此模具未完成,正在研发中');
                }

            });
            $form->saved(function (Form $form, $result) {
                $mould = MouldModel::find($form->mould_id);
                $str = (new \Overtrue\Pinyin\Pinyin)->abbr($mould->name);
                $id = strtoupper($str . str_pad(DB::table('mould_management')->count(), 6, "0", STR_PAD_LEFT));
                $mouldmanagement = MouldManagementModel::find($result);
                $mouldmanagement->mould_management_no = $id;
                $mouldmanagement->save();
            });


            $form->display('created_at');
            $form->display('updated_at');
        });
//            $form->row(function (Form\Row $row) use ($form) {
//                $customers = CustomerRepository::pluck('name', 'id');
//
//                $row->width(6)
//                    ->select('customer_id', '模具归属客户')
//                    ->options($customers)
//                    ->default(head($customers->keys()->toArray()) ?? '')
//                    ->help('非客户,请添加自己公司')
//                    ->required();
//                $row->width(6)->number('lower_limit', '库存下限');
//            });
//
//            $form->row(function (Form\Row $row) use ($form) {
//                $row->width(6)->select('early_warning_mode', '预警方式')
//                    ->options(['1' => '无', '2' => '计次', '3' => '计时(天）'])
//                    ->default('1');
//                $row->width(6)->number('die_life', '理论寿命')
//                    ->help('无预警可空');
//
//            });
//            if ($form->isCreating()) {
//                $form->row(function (Form\Row $row) use ($form) {
//                    $result = MouldTemplateModel::pluck('name', 'id');
//                    $result[0] = '无需模板';
//                    $row->width(6)->radio('type', '模具状态')
//                        ->options(['1' => '成品模具', '模具设计'])
//                        ->default('1');
//                    $row->width(6)->radio('schedule_type', '进度类型')
//                        ->options([0 => "无需选择", '1' => "标准间隔时间", 2 => "计划完成时间"])
//                        ->default(0)
//                        ->help('成品模具，无需选择');
//                    $row->width(6)->select('mould_template_id', '模板选择')
//                        ->options($result)
//                        ->default(0)
//                        ->help('成品模具，无需选择');
//                });
//                $form->saving(function (Form $form) {
//                    if ($form->type > 1) {
//                        if ($form->schedule_type < 1 or $form->mould_template_id < 1) {
//                            return $form->response()->error('模具状态为模具设计,必须选择模具模板与进度类型');
//                        }
//                    }
//
//                });
//                $form->saved(function (Form $form, $result) {
//                    $moulddesign = MouldDesignModel::create([
//                        'super_customer_id'=>$form->super_customer_id,
//                        'mould_template_id' => $form->mould_template_id,
//                        'mould_id' => $result,
//                        'schedule' => 0,
//                        'schedule_type' => $form->schedule_type,
//                    ]);
//                   $MT= MouldTemplateValueModel::where('mould_template_id',$form->mould_template_id)->get();
//                    foreach ($MT as $item) {
//
//                        $moulddesignschedule = MouldDesignScheduleModel::create([
//                            'super_customer_id'=>$form->super_customer_id,
//                            'mould_template_id' => $form->mould_template_id,
//                            'mould_design_id' => $moulddesign->id,
//                            'name' => $item->name,
//                            'admin' => $item->admin,
//                            'play_day' => $item->play_day,
//                            'step_day' => $item->step_day,
//                            'step' => $item->step,
//                            'type' => $form->schedule_type,
//                        ]);
//                    }
//
//                });
//            }
    }
}
