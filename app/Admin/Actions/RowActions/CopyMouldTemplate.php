<?php

namespace App\Admin\Actions\RowActions;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CopyMouldTemplate extends RowAction
{
    /**
     * @return string
     */
    protected $title = '<i class="feather icon-copy"></i>';

    protected $model;

    public function __construct(string $model = null)
    {
        $this->model = $model;
    }


    /**
     * 设置确认弹窗信息，如果返回空值，则不会弹出弹窗
     *
     * 允许返回字符串或数组类型
     *
     * @return array|string|void
     */
    public function confirm()
    {
        return [
            // 确认弹窗 title
            "您确定要复制这个模板数据吗？",
            // 确认弹窗 content
            $this->row->name,
        ];
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return \Dcat\Admin\Actions\Response
     */
    public function handle(Request $request)
    {
        // 获取当前行ID
        $id = $this->getKey();

        // 获取 parameters 方法传递的参数
        $username = $request->get('name');
        $model = $request->get('model');

        // 复制数据
      $newtmp= $model::find($id)->replicate();
      $newtmp->name= $newtmp->name."副本";
      $newtmp->save();
        $value=$model::find($id)->values;
        foreach ($value as $item) {
            $value=$item->replicate();
            $value->mould_template_id=$newtmp->id;
            $value->save();
        }
        // 返回响应结果并刷新页面
        return $this->response()->success("复制成功: [{$username}]")->refresh();
    }

    /**
     * 设置要POST到接口的数据
     *
     * @return array
     */
    public function parameters()
    {
        return [
            // 发送当前行 username 字段数据到接口
            'username' => $this->row->name,
            // 把模型类名传递到接口
            'model' => $this->model,
        ];
    }
}
