<?php

/*
 * // +----------------------------------------------------------------------
 * // | erp
 * // +----------------------------------------------------------------------
 * // | Copyright (c) 2006~2020 erp All rights reserved.
 * // +----------------------------------------------------------------------
 * // | Licensed ( LICENSE-1.0.0 )
 * // +----------------------------------------------------------------------
 * // | Author: yxx <1365831278@qq.com>
 * // +----------------------------------------------------------------------
 */

namespace App\SuperAdmin\Repositories;

use App\Models\AdministratorModel;
use App\Models\RoleUsersModel;
use App\SuperModels\SuperAdministrator;
use App\SuperModels\SuperCustomerModel as Model;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Models\Role;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Traits\HasSelectLoadData;
use Illuminate\Support\Facades\Log;

class SuperCustomer extends EloquentRepository
{
    use HasSelectLoadData;
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function InsertSuperCustomer($form)
    {

        $createdAt = date('Y-m-d H:i:s');
       $admin_user=  AdministratorModel::create([
            'username'   => $form->phone,
            'password'   => bcrypt('admin'),
            'name'       => $form->name,
            'super_customer_id'       => $form->getkey(),
            'created_at' => $createdAt,
        ]);
//       Log:info($admin_user->id);
//      Log::info( ));
        AdministratorModel::find($admin_user->id)->roles()->save(\Dcat\Admin\Models\Role::first());
        RoleUsersModel::where('user_id',$admin_user->id)->update(['super_customer_id'=>$form->getkey()]);
    }
    /**
     * @return Collection
     */
    public function drawee(): Collection
    {
        return DraweeModel::OrderBy('id', 'desc')->pluck('name', 'id');
    }

    /**
     * @param int $customer_id
     * @return SuperCustomer
     */
    public function addressIdText(int $customer_id): self
    {
        $this->textid_array = CustomerAddressModel::where(function (Builder $builder) use ($customer_id) {
            if ($customer_id) {
                $builder->where('customer_id', $customer_id);
            }
        })->OrderBy('id', 'desc')->get();
        return $this;
    }

    /**
     * @param int $customer_id
     * @return SuperCustomer
     */
    public function draweeIdText(int $customer_id): self
    {
        $this->textid_array = DraweeModel::whereHasIn('customer', function (Builder $builder) use ($customer_id) {
            $builder->where('customer_id', $customer_id);
        })->OrderBy('id', 'desc')->get();
        return $this;
    }
}
