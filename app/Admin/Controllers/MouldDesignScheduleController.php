<?php

namespace App\Admin\Controllers;

use Admin;
use App\Admin\Repositories\Mould;
use App\Admin\Repositories\MouldDesign;
use App\Admin\Repositories\MouldDesignSchedule;
use App\Admin\Repositories\MouldType;
use App\Models\BaseModel;
use App\Models\MouldDesignModel;
use App\Models\MouldDesignScheduleModel;
use App\Models\MouldModel;
use App\Models\MouldTemplateModel;
use App\Models\MouldTemplateValueModel;
use App\Repositories\CustomerRepository;
use App\Repositories\MouldRepository;
use App\Repositories\MouldTypeRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Qiniu\Http\Request;
use function Psy\debug;

class MouldDesignScheduleController extends AdminController
{
    public function edit($id, Content $content)
    {
        return $content
            ->body($this->form()->edit($id))->full();
//            ->body($this->grid());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MouldDesignSchedule(), function (Grid $grid) {
            $grid->column('admin');
            $grid->column('name');
            $grid->disablePagination();
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
            $grid->disableFilterButton();
            $grid->disableFilter();
            $grid->disableQuickEditButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableViewButton();
            $grid->disableRefreshButton();
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
        return Form::make(new MouldDesignSchedule(), function (Form $form) {
            $form->disableHeader();
            $form->disableFooter();
            $form->row(function (Form\Row $row) use ($form) {

                $row->width(6)->text('name')->required()->creationRules(['required', 'unique:mould'])
                    ->readOnly();;
                $row->width(6)->text('admin', '负责人')->required()
                    ->readOnly();;
            });
            $form->row(function (Form\Row $row) use ($form) {

                $row->width(6)->date('start_date', '开始时间')
                    ->readOnly();
                $row->width(6)->date('complete_date', '完成时间')
                    ->readOnly();;
            });
            $form->row(function (Form\Row $row) use ($form) {
                $row->textarea('remark', '设计备注');
            });

            $form->saved(function (Form $form,$result) {
                if ($form->type==1){
                    $form->model()->start_date=Carbon::now();
                    $form->model()->save();
                }
                if ($form->type==2){

                    $form->model()->complete_date=Carbon::now();
                    $form->model()->state=2;
                    $form->model()->save();
                    $data=MouldDesignModel::find($form->model()->mould_design_id);
                    if($data->schedule_type==1){
                        $count=  MouldDesignScheduleModel::where('mould_design_id',$form->model()->mould_design_id)
                            ->where('state',2)
                            ->sum('step_day');
                    }else{
                        $count=  MouldDesignScheduleModel::where('mould_design_id',$form->model()->mould_design_id)
                            ->where('state',2)
                            ->sum('step');
                    }
                    $data->update(['schedule'=>$count]);
                    if ($count==100){
                       MouldModel::find($data->mould_id)->update(['type'=>MouldModel::TYPE_COMPLETE]);

                    }
                }
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
