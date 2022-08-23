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

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        Admin::js('static/fullcalendar-scheduler-5.11.2/lib/main.js');
        Admin::css('static/fullcalendar-scheduler-5.11.2/lib/main.css');
        Admin::css('static/fullcalendar-scheduler-5.11.2/lib/locales/zh-cn.js');

        return $content->body(admin_view('admin.index'));

//        Admin::js('/static/fullcalendar-5.11.2/lib/main.js');
//        Admin::css('/static/fullcalendar-5.11.2/lib/main.css');
//        Admin::script(
//            <<<JS
//
//                 Dcat.init( function () {
//                var calendarEl = document.getElementById('calendar');
//                console.log(calendarEl)
//
//                var calendar = new FullCalendar.Calendar(calendarEl, {
//                    initialDate: '2020-09-12',
//                    editable: true,
//                    selectable: true,
//                    businessHours: true,
//                    dayMaxEvents: true, // allow "more" link when too many events
//                    events: [
//                        {
//                            title: 'All Day Event',
//                            start: '2020-09-01'
//                        },
//                        {
//                            title: 'Long Event',
//                            start: '2020-09-07',
//                            end: '2020-09-10'
//                        },
//                        {
//                            groupId: 999,
//                            title: 'Repeating Event',
//                            start: '2020-09-09T16:00:00'
//                        },
//                        {
//                            groupId: 999,
//                            title: 'Repeating Event',
//                            start: '2020-09-16T16:00:00'
//                        },
//                        {
//                            title: 'Conference',
//                            start: '2020-09-11',
//                            end: '2020-09-13'
//                        },
//                        {
//                            title: 'Meeting',
//                            start: '2020-09-12T10:30:00',
//                            end: '2020-09-12T12:30:00'
//                        },
//                        {
//                            title: 'Lunch',
//                            start: '2020-09-12T12:00:00'
//                        },
//                        {
//                            title: 'Meeting',
//                            start: '2020-09-12T14:30:00'
//                        },
//                        {
//                            title: 'Happy Hour',
//                            start: '2020-09-12T17:30:00'
//                        },
//                        {
//                            title: 'Dinner',
//                            start: '2020-09-12T20:00:00'
//                        },
//                        {
//                            title: 'Birthday Party',
//                            start: '2020-09-13T07:00:00'
//                        },
//                        {
//                            title: 'Click for Google',
//                            url: 'http://google.com/',
//                            start: '2020-09-28'
//                        }
//                    ]
//                });
//
//                calendar.render();
//                    });
//
//        JS
//        );

    }
}
//        return $content
//            ->header('Dashboard')
//            ->description('Description...')
//            ->body(function (Row $row) {
//                $row->column(12, function (Column $column) {
//                    $column->row(Dashboard::title());
//                });
//
//                $row->column(6, function (Column $column) {
//                    $column->row(function (Row $row) {
//                        $row->column(6, new Examples\NewUsers());
//                        $row->column(6, new Examples\NewDevices());
//                    });
//
//                    $column->row(new Examples\Sessions());
//                    $column->row(new Examples\ProductOrders());
//                });
//            });
