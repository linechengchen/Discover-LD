<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="javascript" src="{{asset('static/fullcalendar-scheduler-5.11.2/lib/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/fullcalendar-scheduler-5.11.2/lib/main.css')}}"
          crossorigin="anonymous">
    <script src="{{asset('static/fullcalendar-scheduler-5.11.2/lib/locales/zh-cn.js')}}"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <script>


        Dcat.ready(function () {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'zh-cn',
                timeZone: 'PRO',
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    // right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineMonth,resourceTimelineYear'
                },
                initialView: 'resourceTimelineDay',
                scrollTime: '08:00',
                aspectRatio: 1.5,
                resourceAreaColumns: [
                    {
                        group: true,
                        field: 'building',
                        headerContent: '车间'
                    },
                    {
                        field: 'title',
                        headerContent: '机器型号'
                    },
                    {
                        field: 'occupancy',
                        headerContent: '机器编号'
                    }
                ],
                views: {
                    resourceTimelineDay: {
                        buttonText: ':19 slots',
                        slotMinTime: "08:00:00",
                        slotMaxTime: "20:00:00",
                        slotDuration: '04:00'
                    },
                    resourceTimelineTenDay: {
                        type: 'resourceTimeline',
                        duration: {days: 10},
                        buttonText: '10 days',
                        slotMinTime: "08:00:00",
                        slotMaxTime: "17:00:00",
                        slotDuration: '04:30'
                    }
                },
                editable: true,
                resourceAreaHeaderContent: '机器参数',
                resources: [{
                    "id": "a",
                    "building": "一号车间",
                    "title": "Auditorium A",
                    "occupancy":'9999'
                }, {
                    "id": "b",
                    "building": "一号车间",
                    "title": "Auditorium B",
                    "eventColor": "green"
                }, {"id": "c",
                    "building": "一号车间",
                    "title": "Auditorium C", "eventColor": "orange"}, {
                    "id": "d",
                    "title": "Auditorium D",
                    "children": [{"id": "d1", "title": "Room D1"}, {"id": "d2", "title": "Room D2"}]
                }, {"id": "e", "title": "Auditorium E"}, {
                    "id": "f",
                    "title": "Auditorium F",
                    "eventColor": "red"
                }, {"id": "g", "title": "Auditorium G"}, {"id": "h", "title": "Auditorium H"}, {
                    "id": "i",
                    "title": "Auditorium I"
                }, {"id": "j", "title": "Auditorium J"}, {"id": "k", "title": "Auditorium K"}, {
                    "id": "l",
                    "title": "Auditorium L"
                }, {"id": "m", "title": "Auditorium M"}, {"id": "n", "title": "Auditorium N"}, {
                    "id": "o",
                    "title": "Auditorium O"
                }, {"id": "p", "title": "Auditorium P"}, {"id": "q", "title": "Auditorium Q"}, {
                    "id": "r",
                    "title": "Auditorium R"
                }, {"id": "s", "title": "Auditorium S"}, {"id": "t", "title": "Auditorium T"}, {
                    "id": "u",
                    "title": "Auditorium U"
                }, {"id": "v", "title": "Auditorium V"}, {"id": "w", "title": "Auditorium W"}, {
                    "id": "x",
                    "title": "Auditorium X"
                }, {"id": "y", "title": "Auditorium Y"}, {"id": "z", "title": "Auditorium Z"}],
                events: [
                    {
                        "resourceId": "a",
                        "color":'red',
                        "title": "机器离线",
                        "start": "2022-08-17T08:00:00+00:00",
                        "end": "2022-08-17T11:00:00+00:00"
                    },

                    {
                        "resourceId": "a",
                        "title": "机器在线",
                        "start": "2022-08-17T11:00:00+00:00",
                        "end": "2022-08-17T12:30:00+00:00"
                    },
                    {
                        "resourceId": "a",
                        "title": "戒指x52生产数量:999",
                        "color":'gray',
                        "start": "2022-08-17T11:00:00+00:00",
                        "end": "2022-08-17T12:30:00+00:00"
                    },
                    {
                        "resourceId": "a",
                        "title": "工单号:0577-ML项链-生产数量:5200-  排产日期:2022-08-15T11:00至2022-08-20T12:30",
                        "start": "2022-08-15T11:00:00+00:00",
                        "end": "2022-08-20T12:30:00+00:00"
                    },
                    {
                    "resourceId": "d",
                    "title": "休息日",
                    "start": "2022-08-17T08:00:00+00:00",
                    "end": "2022-08-18"
                }, {
                    "resourceId": "c",
                    "title": "event 3",
                    "start": "2022-08-17T12:00:00+00:00",
                    "end": "2022-08-18T06:00:00+00:00"
                }, {
                    "resourceId": "f",
                    "title": "event 4",
                    "start": "2022-08-17T07:30:00+00:00",
                    "end": "2022-08-17T09:30:00+00:00"
                }, {
                    "resourceId": "b",
                    "title": "event 5",
                    "start": "2022-08-17T10:00:00+00:00",
                    "end": "2022-08-17T15:00:00+00:00"
                }, {
                    "resourceId": "e",
                    "title": "event 2",
                    "start": "2022-08-17T09:00:00+00:00",
                    "end": "2022-08-17T14:00:00+00:00"
                }],


            });
            calendar.render();
        });
        // Dcat.ready(function () {
        //     var calendarEl = document.getElementById('calendar');
        //
        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         locale: 'zh-cn',
        //         timeZone: 'PRO',
        //         headerToolbar: {
        //             left: 'today prev,next',
        //             center: 'title',
        //             right: 'resourceTimelineDay,resourceTimelineWeek'
        //         },
        //         aspectRatio: 1.5,
        //         initialView: 'resourceTimelineDay',
        //         scrollTimeReset:true,
        //         views: {
        //             resourceTimelineDay: {
        //                 type: 'resourceTimeline',
        //                 buttonText: '日',
        //                 slotMinTime: "08:00:00",
        //                 slotMaxTime: "17:00:00",
        //                 slotLabelInterval: "04:30",
        //
        //             },
        //             resourceTimelineWeek: {
        //                 slotMinTime: "08:00:00",
        //                 slotMaxTime: "17:00:00",
        //                 type: 'resourceTimelineWeek',
        //                 buttonText: '周',
        //                 slotLabelInterval: "04:30",
        //                 scrollTimeReset:true,
        //             }
        //         },
        //         resourceAreaWidth: '40%',
        //         resourceAreaColumns: [
        //             {
        //                 group: true,
        //                 field: 'building',
        //                 headerContent: '车间'
        //             },
        //             {
        //                 field: 'title',
        //                 headerContent: '机器型号'
        //             },
        //             {
        //                 field: 'occupancy',
        //                 headerContent: '机器编号'
        //             }
        //         ],
        //         resources: [
        //             {id: 'a', building: '460 Bryant', title: 'Auditorium A', occupancy: 40},
        //             {id: 'b', building: '460 Bryant', title: 'Auditorium B', occupancy: 40},
        //             {id: 'c', building: '460 Bryant', title: 'Auditorium C', occupancy: 40},
        //             {id: 'd', building: '460 Bryant', title: 'Auditorium D', occupancy: 40},
        //             {id: 'e', building: '460 Bryant', title: 'Auditorium E', occupancy: 40},
        //             {id: 'f', building: '460 Bryant', title: 'Auditorium F', occupancy: 40},
        //             {id: 'g', building: '564 Pacific', title: 'Auditorium G', occupancy: 40},
        //             {id: 'h', building: '564 Pacific', title: 'Auditorium H', occupancy: 40},
        //             {id: 'i', building: '564 Pacific', title: 'Auditorium I', occupancy: 40},
        //             {id: 'j', building: '564 Pacific', title: 'Auditorium J', occupancy: 40},
        //             {id: 'k', building: '564 Pacific', title: 'Auditorium K', occupancy: 40},
        //             {id: 'l', building: '564 Pacific', title: 'Auditorium L', occupancy: 40},
        //             {id: 'm', building: '564 Pacific', title: 'Auditorium M', occupancy: 40},
        //             {id: 'n', building: '564 Pacific', title: 'Auditorium N', occupancy: 40},
        //             {id: 'o', building: '564 Pacific', title: 'Auditorium O', occupancy: 40},
        //             {id: 'p', building: '564 Pacific', title: 'Auditorium P', occupancy: 40},
        //             {id: 'q', building: '564 Pacific', title: 'Auditorium Q', occupancy: 40},
        //             {id: 'r', building: '564 Pacific', title: 'Auditorium R', occupancy: 40},
        //             {id: 's', building: '564 Pacific', title: 'Auditorium S', occupancy: 40},
        //             {id: 't', building: '564 Pacific', title: 'Auditorium T', occupancy: 40},
        //             {id: 'u', building: '564 Pacific', title: 'Auditorium U', occupancy: 40},
        //             {id: 'v', building: '564 Pacific', title: 'Auditorium V', occupancy: 40},
        //             {id: 'w', building: '564 Pacific', title: 'Auditorium W', occupancy: 40},
        //             {id: 'x', building: '564 Pacific', title: 'Auditorium X', occupancy: 40},
        //             {id: 'y', building: '564 Pacific', title: 'Auditorium Y', occupancy: 40},
        //             {id: 'z', building: '564 Pacific', title: 'Auditorium Z', occupancy: 40}
        //         ]
        //     });
        //
        //     calendar.render();
        // });
    </script>
</head>

<body>
<div id='calendar'></div>
</body>


</html>
