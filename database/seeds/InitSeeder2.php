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
namespace Database\Seeders;
use App\Models\AdministratorModel;
use App\SuperModels\SuperAdministrator;
use App\SuperModels\SuperMenu;
use App\SuperModels\SuperPermission;
use App\SuperModels\SuperRole;
use Illuminate\Database\Seeder;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Role;
use Dcat\Admin\Models\Permission;
use Dcat\Admin\Models\Administrator;
use Illuminate\Support\Facades\DB;

class InitSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdministratorModel::find(2)->roles()->save(Role::first());
    }

}
