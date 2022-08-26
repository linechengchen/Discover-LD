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

use App\Models\TeamModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/test', function (Request $request) {
    dd(123);
})->name('test');
Route::get('/getevents', function (Request $request) {
    $workshop = \App\Models\WorkShopModel::find($request->workshop_id);

    $period = new CarbonPeriod($request->start, '1 day', $request->end);
    $workday = [];
    foreach ($period as $item) {
        foreach ($workshop->values as $value) {
            if (!TeamModel::where(['restday' => $item->toDate(), 'work_shop_id' => $request->workshop_id])->exists()) {
                $workday[] = [
                    'title' => $value->name,
                    'start' => Carbon::create($item)->addHours(explode(':', $value->start)[0])->addMinute(explode(':', $value->start)[1])->addSecond(explode(':', $value->start)[2])->toDateTimeString(),
                    'end' => Carbon::create($item)->addHours(explode(':', $value->end)[0])->addMinute(explode(':', $value->end)[1])->addSecond(explode(':', $value->end)[2])->toDateTimeString(),
                ];

            } else {
                $workday[] = [
                    'title' => '休息日',
                    'start' => Carbon::create($item)->addHours(explode(':', $value->start)[0])->addMinute(explode(':', $value->start)[1])->addSecond(explode(':', $value->start)[2])->toDateTimeString(),
                    'end' => Carbon::create($item)->addHours(explode(':', $value->end)[0])->addMinute(explode(':', $value->end)[1])->addSecond(explode(':', $value->end)[2])->toDateTimeString(),
                ];
            }


        }

    }
    return $workday;


});
Route::get('/set_restday', function (Request $request) {
    $team = new TeamModel();

    if ($request->look == 1) {
        $team= TeamModel::where(['restday'=>$request->restday, 'work_shop_id'=> $request->work_shop_id, 'super_customer_id'=> $request->super_customer_id])->first();

        if ($team) {
            return ['data'=>$team,'type'=>1];
        } else {
            return ['data'=>$team,'type'=>0];
        }
    } else {
        if (empty($request->del_id)){
            $team->restday = $request->restday;
            $team->work_shop_id = $request->work_shop_id;
            $team->super_customer_id = $request->super_customer_id;
            $team->save();
            return ['data'=>$team];
        }else{
            return ['data'=>$team,'deltype'=>TeamModel::find($request->del_id)->delete()];
        }


    }


});
