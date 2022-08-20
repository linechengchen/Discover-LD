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

use App\Models\MouldDesignModel;
use App\Models\MouldDesignScheduleModel;
use App\Models\MouldModel;
use App\Models\MouldTypeModel;
use App\Models\WorkShopModel;
use App\Models\WorkShopValueModel;
use App\Repositories\MouldRepository;
use Faker\Generator as Faker;
use App\Models\MouldTemplateModel;
use App\Models\MouldTemplateValueModel;
use App\SuperModels\SuperAdministrator;
use App\SuperModels\SuperCustomerModel;
use App\SuperModels\SuperMenu;
use App\SuperModels\SuperPermission;
use App\SuperModels\SuperRole;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Role;
use Dcat\Admin\Models\Permission;
use Dcat\Admin\Models\Administrator;
use Illuminate\Support\Facades\DB;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin();
        $this->super_admin();
    }

    public function InitMouldTemplate()
    {
        $faker = \Faker\Factory::create('zh_CN');

        MouldTemplateModel::truncate();

        MouldTemplateModel::truncate();
        MouldTemplateValueModel::truncate();
        MouldTypeModel::truncate();
        MouldModel::truncate();
        MouldDesignModel::truncate();
        MouldDesignScheduleModel::truncate();
        $createdAt = date('Y-m-d H:i:s');

        $mt = MouldTemplateModel::create([
            'name' => "模板",
            'super_customer_id' => 2,
            'created_at' => $createdAt
        ]);
        MouldTemplateValueModel::create([
            'mould_template_id' => $mt->id,
            'name' => "工序1",
            'admin' => $faker->name,
            'play_day' => 5,
            'step_day' => 50,
            'step' => 20,
            'created_at' => $createdAt,
        ]);
        MouldTemplateValueModel::create([
            'mould_template_id' => $mt->id,
            'name' => "工序2",
            'admin' => $faker->name,
            'play_day' => 5,
            'step_day' => 50,
            'step' => 80,
            'created_at' => $createdAt,
        ]);
        $mould_type = MouldTypeModel::create([
            'name' => '简单'
        ]);
        $mould_type = MouldTypeModel::create([
            'name' => '复杂'
        ]);
        $mould = MouldModel::create([
            'name' => '最初的模具',
            'mould_type_id' => 1,
            'mould_no' => 'MD000001',
            'manufacturer' => '正博',
            'customer_id' => '1',
            'early_warning_mode' => 1,
            'die_life' => 1000,
            'super_customer_id' => 2,
            'type' => 1,
            'mould_template_id' => null,
            'schedule_type' => 1,
            'lower_limit' => 10,
        ]);


        $mould2 = MouldModel::create([
            'name' => '标准间隔时间模具',
            'mould_type_id' => 2,
            'mould_no' => 'MD000002',
            'manufacturer' => '正博',
            'customer_id' => '1',
            'early_warning_mode' => 2,
            'die_life' => 1000,
            'super_customer_id' => 2,
            'type' => 2,
            'mould_template_id' => 1,
            'schedule_type' => 2,
            'lower_limit' => 10,
        ]);
        $moulddesign = MouldDesignModel::create([
            'super_customer_id' => $mould2->super_customer_id,
            'mould_template_id' => $mould2->mould_template_id,
            'mould_id' => $mould2->id,
            'schedule' => 0,
            'schedule_type' => $mould2->schedule_type,
        ]);
        $MT = MouldTemplateValueModel::where('mould_template_id', $mould2->mould_template_id)->get();
        foreach ($MT as $item) {
            $moulddesignschedule = MouldDesignScheduleModel::create([
                'super_customer_id' => $mould2->super_customer_id,
                'mould_template_id' => $mould2->mould_template_id,
                'mould_design_id' => $moulddesign->id,
                'name' => $item->name,
                'admin' => $item->admin,
                'play_day' => $item->play_day,
                'step_day' => $item->step_day,
                'step' => $item->step,
                'type' => $item->schedule_type,
            ]);
        }

//        计划完成时间模具
        $mould3 = MouldModel::create([
            'name' => '计划完成时间模具',
            'mould_type_id' => 2,
            'mould_no' => 'MD000003',
            'manufacturer' => '正博',
            'customer_id' => '1',
            'early_warning_mode' => 2,
            'die_life' => 1000,
            'super_customer_id' => 2,
            'type' => 2,
            'mould_template_id' => 1,
            'schedule_type' => 1,
            'lower_limit' => 10,
        ]);
        $moulddesign3 = MouldDesignModel::create([
            'super_customer_id' => $mould3->super_customer_id,
            'mould_template_id' => $mould3->mould_template_id,
            'mould_id' => $mould3->id,
            'schedule' => 0,
            'schedule_type' => $mould3->schedule_type,
        ]);
        $MT = MouldTemplateValueModel::where('mould_template_id', $mould3->mould_template_id)->get();
        foreach ($MT as $item) {
            $moulddesignschedule = MouldDesignScheduleModel::create([
                'super_customer_id' => $mould3->super_customer_id,
                'mould_template_id' => $mould3->mould_template_id,
                'mould_design_id' => $moulddesign3->id,
                'name' => $item->name,
                'admin' => $item->admin,
                'play_day' => $item->play_day,
                'step_day' => $item->step_day,
                'step' => $item->step,
                'type' => $item->schedule_type,
            ]);
        }
    }

    public function admin()
    {
        $createdAt = date('Y-m-d H:i:s');

        // create a user.

        Role::truncate();
        Menu::truncate();
        Permission::truncate();
        Administrator::truncate();
        DB::table('admin_roles')->truncate();
        DB::table('admin_users')->truncate();
        DB::table('admin_permissions')->truncate();
        DB::table('admin_role_users')->truncate();
        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_permission_menu')->truncate();
        DB::table('admin_role_menu')->truncate();

        Administrator::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
            'created_at' => $createdAt,
        ]);
        Administrator::create([
            'username' => '18324254558',
            'password' => bcrypt('admin'),
            'name' => '正博智能机械',
            'created_at' => $createdAt,
        ]);

        // create a role.
        $this->InitMouldTemplate();
        $this->InitBaseData();
        Role::create([
            'name' => 'Administrator',
            'slug' => Role::ADMINISTRATOR,
            'created_at' => $createdAt,
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());
        Administrator::find(2)->roles()->save(Role::first());

        //create a permission

        Permission::insert([
            [
                'id' => 1,
                'name' => '权限管理',
                'slug' => 'auth-management',
                'http_method' => '',
                'http_path' => '',
                'parent_id' => 0,
                'order' => 1,
                'created_at' => $createdAt,
            ],
            [
                'id' => 2,
                'name' => '管理员',
                'slug' => 'users',
                'http_method' => '',
                'http_path' => '/users*',
                'parent_id' => 1,
                'order' => 2,
                'created_at' => $createdAt,
            ],
            [
                'id' => 3,
                'name' => '角色',
                'slug' => 'roles',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'parent_id' => 1,
                'order' => 3,
                'created_at' => $createdAt,
            ],
            [
                'id' => 4,
                'name' => '权限',
                'slug' => 'permissions',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'parent_id' => 1,
                'order' => 4,
                'created_at' => $createdAt,
            ],
            [
                'id' => 5,
                'name' => '菜单',
                'slug' => 'menu',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'parent_id' => 1,
                'order' => 5,
                'created_at' => $createdAt,
            ],
            [
                'id' => 6,
                'name' => '日志',
                'slug' => 'operation-log',
                'http_method' => '',
                'http_path' => '/auth/logs*',
                'parent_id' => 1,
                'order' => 6,
                'created_at' => $createdAt,
            ],
        ]);

//        Role::first()->permissions()->save(Permission::first());

        // add default menus.

        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '可视化排程',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '权限管理',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => '',
                'uri' => 'auth/users',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => '',
                'uri' => 'auth/roles',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限',
                'icon' => '',
                'uri' => 'auth/permissions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单',
                'icon' => '',
                'uri' => 'auth/menu',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => '日志',
                'icon' => '',
                'uri' => 'auth/logs',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => '产品管理',
                'icon' => 'fa-product-hunt',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 9,
                'title' => '产品档案',
                'icon' => '',
                'uri' => 'products',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 10,
                'title' => '产品单位',
                'icon' => '',
                'uri' => 'units',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 11,
                'title' => '产品属性',
                'icon' => '',
                'uri' => 'attrs',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 12,
                'title' => '采购管理',
                'icon' => 'fa-cart-plus',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 12,
                'order' => 13,
                'title' => '供应商档案',
                'icon' => '',
                'uri' => 'suppliers',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 12,
                'order' => 14,
                'title' => '采购订购单',
                'icon' => '',
                'uri' => 'purchase-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 12,
                'order' => 15,
                'title' => '采购入库单',
                'icon' => '',
                'uri' => 'purchase-in-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 16,
                'title' => '库存管理',
                'icon' => 'fa-ambulance',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 16,
                'order' => 17,
                'title' => '产品库存',
                'icon' => '',
                'uri' => 'sku-stocks',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 16,
                'order' => 18,
                'title' => '批次库存',
                'icon' => '',
                'uri' => 'sku-stock-batchs',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 16,
                'order' => 19,
                'title' => '仓库库位',
                'icon' => '',
                'uri' => 'positions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 16,
                'order' => 20,
                'title' => '库存往来',
                'icon' => '',
                'uri' => 'stock-historys',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 16,
                'order' => 21,
                'title' => '期初建账',
                'icon' => '',
                'uri' => 'init-stock-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 22,
                'title' => '销售管理',
                'icon' => 'fa-calendar-minus-o',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 23,
                'title' => '客户档案',
                'icon' => '',
                'uri' => 'customers',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 24,
                'title' => '付款人信息',
                'icon' => '',
                'uri' => 'drawees',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 25,
                'title' => '客户要货单',
                'icon' => '',
                'uri' => 'sale-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 26,
                'title' => '客户出货单',
                'icon' => '',
                'uri' => 'sale-out-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 27,
                'title' => '客户退货单',
                'icon' => '',
                'uri' => 'sale-in-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 28,
                'title' => '生产加工',
                'icon' => 'fa-wrench',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 28,
                'order' => 29,
                'title' => '生产任务',
                'icon' => '',
                'uri' => 'tasks',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 28,
                'order' => 30,
                'title' => '生产工艺',
                'icon' => '',
                'uri' => 'crafts',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 28,
                'order' => 31,
                'title' => '物料申领',
                'icon' => '',
                'uri' => 'apply-for-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 28,
                'order' => 32,
                'title' => '生产入库',
                'icon' => '',
                'uri' => 'make-product-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 33,
                'title' => '盘点管理',
                'icon' => 'fa-database',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 33,
                'order' => 34,
                'title' => '盘点任务',
                'icon' => '',
                'uri' => 'inventorys',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 33,
                'order' => 35,
                'title' => '盘点单据',
                'icon' => '',
                'uri' => 'inventory-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 36,
                'title' => '财务管理',
                'icon' => 'fa-money',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 36,
                'order' => 37,
                'title' => '会计期',
                'icon' => '',
                'uri' => 'accountant-dates',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 36,
                'order' => 38,
                'title' => '月结',
                'icon' => '',
                'uri' => 'month-settlements/create',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 36,
                'order' => 39,
                'title' => '费用单',
                'icon' => '',
                'uri' => 'cost-orders',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 36,
                'order' => 40,
                'title' => '结算单',
                'icon' => '',
                'uri' => 'statement-orders',
                'created_at' => $createdAt,
            ],

            [
                'parent_id' => 22,
                'order' => 24,
                'title' => '付款方式',
                'icon' => '',
                'uri' => 'pay-method',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 22,
                'order' => 22,
                'title' => '员工档案',
                'icon' => '',
                'uri' => 'salesman',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 41,
                'title' => '模具设计',
                'icon' => 'feather icon-cpu',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 43,
                'order' => 41,
                'title' => '模具类型',
                'icon' => 'feather icon-cpu',
                'uri' => 'mould-type',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 43,
                'order' => 41,
                'title' => '模具模板',
                'icon' => 'feather icon-cpu',
                'uri' => 'mould-template',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 43,
                'order' => 41,
                'title' => '模具档案',
                'icon' => 'feather icon-cpu',
                'uri' => 'mould',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 43,
                'order' => 41,
                'title' => '模具设计',
                'icon' => 'feather icon-cpu',
                'uri' => 'mould-design',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 42,
                'title' => '模具管理',
                'icon' => 'feather icon-save',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 48,
                'order' => 42,
                'title' => '模具库存',
                'icon' => 'feather icon-grid',
                'uri' => 'mould-management',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '基础数据',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 50,
                'order' => 2,
                'title' => '车间管理',
                'icon' => 'fa-calendar',
                'uri' => 'work-shop',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 50,
                'order' => 3,
                'title' => '班组管理',
                'icon' => 'fa-calendar',
                'uri' => 'team',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 9999,
                'title' => '需求反馈',
                'icon' => 'fa-comment-o',
                'uri' => 'demands',
                'created_at' => $createdAt,
            ],

        ]);

        (new Menu())->flushCache();
    }

    public function super_admin()
    {
        $createdAt = date('Y-m-d H:i:s');

        // create a user.

        SuperRole::truncate();
        SuperCustomerModel::truncate();
        SuperMenu::truncate();
        SuperPermission::truncate();
        SuperAdministrator::truncate();
        DB::table('super_admin_roles')->truncate();
        DB::table('super_admin_users')->truncate();
        DB::table('super_admin_permissions')->truncate();
        DB::table('super_admin_role_users')->truncate();
        DB::table('super_admin_role_permissions')->truncate();
        DB::table('super_admin_permission_menu')->truncate();
        DB::table('super_admin_role_menu')->truncate();

        SuperAdministrator::create([
            'username' => 'sadmin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
            'created_at' => $createdAt,
        ]);

        // create a role.

        SuperRole::create([
            'name' => 'Administrator',
            'slug' => Role::ADMINISTRATOR,
            'created_at' => $createdAt,
        ]);

//

        // add role to user.
        SuperAdministrator::first()->roles()->save(SuperRole::first());
        //create a permission

        SuperPermission::insert([
            [
                'id' => 1,
                'name' => '权限管理',
                'slug' => 'auth-management',
                'http_method' => '',
                'http_path' => '',
                'parent_id' => 0,
                'order' => 1,
                'created_at' => $createdAt,
            ],
            [
                'id' => 2,
                'name' => '管理员',
                'slug' => 'users',
                'http_method' => '',
                'http_path' => '/auth/users*',
                'parent_id' => 1,
                'order' => 2,
                'created_at' => $createdAt,
            ],
            [
                'id' => 3,
                'name' => '角色',
                'slug' => 'roles',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'parent_id' => 1,
                'order' => 3,
                'created_at' => $createdAt,
            ],
            [
                'id' => 4,
                'name' => '权限',
                'slug' => 'permissions',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'parent_id' => 1,
                'order' => 4,
                'created_at' => $createdAt,
            ],
            [
                'id' => 5,
                'name' => '菜单',
                'slug' => 'menu',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'parent_id' => 1,
                'order' => 5,
                'created_at' => $createdAt,
            ],
            [
                'id' => 6,
                'name' => '日志',
                'slug' => 'operation-log',
                'http_method' => '',
                'http_path' => '/auth/logs*',
                'parent_id' => 1,
                'order' => 6,
                'created_at' => $createdAt,
            ],
        ]);

//        Role::first()->permissions()->save(Permission::first());

        // add default menus.

        SuperMenu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '权限管理',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => '',
                'uri' => 'auth/users',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => '',
                'uri' => 'auth/roles',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限',
                'icon' => '',
                'uri' => 'auth/permissions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单',
                'icon' => '',
                'uri' => 'auth/menu',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => '日志',
                'icon' => '',
                'uri' => 'auth/logs',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => '客户管理',
                'icon' => 'feather icon-user-check',
                'uri' => 'super-customer',
                'created_at' => $createdAt,
            ],
//            [
//                'parent_id'     => 8,
//                'order'         => 9,
//                'title'         => '产品档案',
//                'icon'          => '',
//                'uri'           => 'products',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 8,
//                'order'         => 10,
//                'title'         => '产品单位',
//                'icon'          => '',
//                'uri'           => 'units',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 8,
//                'order'         => 11,
//                'title'         => '产品属性',
//                'icon'          => '',
//                'uri'           => 'attrs',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 12,
//                'title'         => '采购管理',
//                'icon'          => 'fa-cart-plus',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 12,
//                'order'         => 13,
//                'title'         => '供应商档案',
//                'icon'          => '',
//                'uri'           => 'suppliers',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 12,
//                'order'         => 14,
//                'title'         => '采购订购单',
//                'icon'          => '',
//                'uri'           => 'purchase-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 12,
//                'order'         => 15,
//                'title'         => '采购入库单',
//                'icon'          => '',
//                'uri'           => 'purchase-in-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 16,
//                'title'         => '库存管理',
//                'icon'          => 'fa-ambulance',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 16,
//                'order'         => 17,
//                'title'         => '产品库存',
//                'icon'          => '',
//                'uri'           => 'sku-stocks',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 16,
//                'order'         => 18,
//                'title'         => '批次库存',
//                'icon'          => '',
//                'uri'           => 'sku-stock-batchs',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 16,
//                'order'         => 19,
//                'title'         => '仓库库位',
//                'icon'          => '',
//                'uri'           => 'positions',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 16,
//                'order'         => 20,
//                'title'         => '库存往来',
//                'icon'          => '',
//                'uri'           => 'stock-historys',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 16,
//                'order'         => 21,
//                'title'         => '期初建账',
//                'icon'          => '',
//                'uri'           => 'init-stock-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 22,
//                'title'         => '销售管理',
//                'icon'          => 'fa-calendar-minus-o',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 23,
//                'title'         => '客户档案',
//                'icon'          => '',
//                'uri'           => 'customers',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 24,
//                'title'         => '付款人信息',
//                'icon'          => '',
//                'uri'           => 'drawees',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 25,
//                'title'         => '客户要货单',
//                'icon'          => '',
//                'uri'           => 'sale-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 26,
//                'title'         => '客户出货单',
//                'icon'          => '',
//                'uri'           => 'sale-out-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 27,
//                'title'         => '客户退货单',
//                'icon'          => '',
//                'uri'           => 'sale-in-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 28,
//                'title'         => '生产加工',
//                'icon'          => 'fa-wrench',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 28,
//                'order'         => 29,
//                'title'         => '生产任务',
//                'icon'          => '',
//                'uri'           => 'tasks',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 28,
//                'order'         => 30,
//                'title'         => '生产工艺',
//                'icon'          => '',
//                'uri'           => 'crafts',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 28,
//                'order'         => 31,
//                'title'         => '物料申领',
//                'icon'          => '',
//                'uri'           => 'apply-for-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 28,
//                'order'         => 32,
//                'title'         => '生产入库',
//                'icon'          => '',
//                'uri'           => 'make-product-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 33,
//                'title'         => '盘点管理',
//                'icon'          => 'fa-database',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 33,
//                'order'         => 34,
//                'title'         => '盘点任务',
//                'icon'          => '',
//                'uri'           => 'inventorys',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 33,
//                'order'         => 35,
//                'title'         => '盘点单据',
//                'icon'          => '',
//                'uri'           => 'inventory-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 36,
//                'title'         => '财务管理',
//                'icon'          => 'fa-money',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 36,
//                'order'         => 37,
//                'title'         => '会计期',
//                'icon'          => '',
//                'uri'           => 'accountant-dates',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 36,
//                'order'         => 38,
//                'title'         => '月结',
//                'icon'          => '',
//                'uri'           => 'month-settlements/create',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 36,
//                'order'         => 39,
//                'title'         => '费用单',
//                'icon'          => '',
//                'uri'           => 'cost-orders',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 36,
//                'order'         => 40,
//                'title'         => '结算单',
//                'icon'          => '',
//                'uri'           => 'statement-orders',
//                'created_at'    => $createdAt,
//            ],
//
//            [
//                'parent_id'     => 22,
//                'order'         => 24,
//                'title'         => '付款方式',
//                'icon'          => '',
//                'uri'           => 'pay-method',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 22,
//                'order'         => 22,
//                'title'         => '员工档案',
//                'icon'          => '',
//                'uri'           => 'salesman',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 41,
//                'title'         => '模具设计',
//                'icon'          => 'feather icon-cpu',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 43,
//                'order'         => 41,
//                'title'         => '模具类型',
//                'icon'          => 'feather icon-cpu',
//                'uri'           => 'mould-type',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 43,
//                'order'         => 41,
//                'title'         => '模具档案',
//                'icon'          => 'feather icon-cpu',
//                'uri'           => 'mould',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 42,
//                'title'         => '模具管理',
//                'icon'          => 'feather icon-save',
//                'uri'           => '',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 43,
//                'title'         => '报表中心',
//                'icon'          => 'fa-calendar',
//                'uri'           => 'report-centers',
//                'created_at'    => $createdAt,
//            ],
//            [
//                'parent_id'     => 0,
//                'order'         => 9999,
//                'title'         => '需求反馈',
//                'icon'          => 'fa-comment-o',
//                'uri'           => 'demands',
//                'created_at'    => $createdAt,
//            ],
        ]);

        (new SuperMenu())->flushCache();
    }

    private function InitBaseData()
    {
        $workshop = WorkShopModel::create([
            'name' => "车间1号",
            'super_customer_id' => "2",
        ]);
        $workshop2 = WorkShopModel::create([
            'name' => "车间2号",
            'super_customer_id' => "2",
        ]);
        WorkShopValueModel::create([
            'super_customer_id' => "2",
            'work_shop_id' => $workshop2->id,
            'name' => "早班",
            'start' => '08:00:00',
            'end' => '12:00:00'
        ]);
        WorkShopValueModel::create([
            'super_customer_id' => "2",
            'work_shop_id' => $workshop2->id,
            'name' => "午班",
            'start' => '13:00:00',
            'end' => '15:00:00'
        ]);
        WorkShopValueModel::create([
            'super_customer_id' => "2",
            'work_shop_id' => $workshop->id,
            'name' => "早班",
            'start' => '08:00:00',
            'end' => '12:00:00'
        ]);
        WorkShopValueModel::create([
            'super_customer_id' => "2",
            'work_shop_id' => $workshop->id,
            'name' => "午班",
            'start' => '13:00:00',
            'end' => '15:00:00'
        ]);
    }

}
