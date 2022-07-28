<?php


use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('super-admin.route.prefix'),
    'namespace'  => config('super-admin.route.namespace'),
    'middleware' => config('super-admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('super-customer', 'SuperCustomerController');

});
