<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script>

        @foreach($workshop as $k=>$d)
        var calendarEl{{$d['id']}} = document.getElementById('calendar{{$d['id']}}');
        var calendar{{$d['id']}} = new FullCalendar.Calendar(calendarEl{{$d['id']}}, {
            headerToolbar: {
                left: 'today prev,next',
                center: 'title',
                right: 'resourceTimelineDay,timeGridWeek,dayGridMonth'
            },
            initialView: 'dayGridMonth',
            locale: 'zh-CN',
            selectable: true,
            dateClick: function (info) {
                alert('Date: ' + info.dateStr);
                alert('Resource ID: ' + info.resource.id);
            },
            resources: [
                    @foreach($d->values as $v)
                {
                    id: {{$v->id}}, title: '{{$v->name}}'
                },
                @endforeach()

            ],
            events: [
                    @foreach($d->values as $v)
                {
                    allDay: false,
                    daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                    title: '{{$v->name }}',
                    startTime: '{{$v->start}}+00:00',
                    endTime: '{{$v->end}}+00:00',
                    resourceId: {{$v->id}}
                },
                @endforeach()
                    '/feed2.php'
            ]


        });
        calendar{{$d['id']}}.render();
        $("#calendar{{$d['id']}}").hide()
        @endforeach

        $("#calendar{{$workshop[0]->id}}").show()
        $("#workshop").change(function(){
            console.log($(this).val())
            $('div[id^=calendar]').hide();
            $('#calendar'+$(this).val()).show();
        })
    </script>

</head>
<body>
<div x-data="{ count: 0,workshop_id:{{$workshop[0]->id}},color:2 }">
    <div class="form-group col-sm-4">
        <label>选择车间:</label>
        <select  x-model="color">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        Color: <span x-text="color"></span>
        <select id="workshop" x-model="workshop_id" class="form-control">
            @foreach($workshop as $d)
                <option value="{{$d['id']}}">{{$d['name']}}</option>
            @endforeach
        </select>

    </div>
    @foreach($workshop as $d)

        name: <span>{{$d->name}}</span>

        <div id='calendar{{$d['id']}}'></div>
    @endforeach
</div>

</div>
</body>
<style>
    .important {
        display: none !important;
    }
</style>

</html>
