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

namespace App\SuperModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CustomerModel
 *
 * @property int $id
 * @property string $name 属性名称
 * @property string $link 联系人
 * @property int $pay_method 支付方式
 * @property string $phone 手机号码
 * @property string $other 备注
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SuperModels\CustomerAddressModel[] $address
 * @property-read int|null $address_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SuperModels\DraweeModel[] $drawee
 * @property-read int|null $drawee_count
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|SuperCustomerModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel wherePayMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuperCustomerModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SuperCustomerModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SuperCustomerModel withoutTrashed()
 * @mixin \Eloquent
 */
class SuperCustomerModel extends BaseModel
{
    use SoftDeletes;

    protected $table = 'super_customer';

    const PAY_CASH = 0;
    const PAY_WECHAT = 1;
    const PAY_ZFB = 2;

    const PAY = [
        self::PAY_CASH   => '现金',
        self::PAY_WECHAT => '微信',
        self::PAY_ZFB    => '支付宝',
    ];

    /**
     * @return BelongsToMany
     */
    public function drawee(): BelongsToMany
    {
        return $this->belongsToMany(DraweeModel::class, CustomerDraweeModel::class, 'customer_id', 'drawee_id');
    }

    /**
     * @return HasMany
     */
    public function address(): HasMany
    {
        return $this->hasMany(CustomerAddressModel::class, 'customer_id');
    }
}
