<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <script>
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'zh-cn',
            timeZone: 'Asia/Shanghai',
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
                    slotMaxTime: "10:00:00",
                    slotDuration: '02:00'
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

        if (calendarEl != null) {
            calendar.render();
        }

    </script>
</head>

<body>
<div id='calendar'></div>
</body>


</html>
