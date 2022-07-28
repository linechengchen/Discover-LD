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

namespace App\Admin\SuperRepositories;

use App\SuperModels\SuperCustomerModel as Model;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Traits\HasSelectLoadData;

class SuperCustomer extends EloquentRepository
{
    use HasSelectLoadData;
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

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
