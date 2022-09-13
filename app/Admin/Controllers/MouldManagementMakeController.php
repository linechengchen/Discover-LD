<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Mould;
use App\Admin\Repositories\MouldDesign;
use App\Admin\Repositories\MouldManagement;
use App\Admin\Repositories\MouldManagementMake;
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

class MouldManagementMakeController extends AdminController
{


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MouldManagementMake(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');

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
        return Show::make($id, new MouldManagementMake(), function (Show $show) {
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
        return Form::make(new  MouldManagementMake('mould_management_make_value'), function (Form $form) {
            $form->text('name','模具组名称')->creationRules(['unique:mould_management_make'])->updateRules(['unique:mould_management_make'])->required();
            $form->hasMany('mould_management_make_value', '属性值', function (Form\NestedForm $table) {
                $table->select('mould_id', '模具型号')->options(MouldModel::where('type',1)->pluck('name','id'))->required();
                $table->text('remark', '模具套件备注');

            })->useTable();
            $form->text('remark','模具组备注');
        });


    }
}
