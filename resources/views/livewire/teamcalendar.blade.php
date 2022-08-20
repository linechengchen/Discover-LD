<script>


    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
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
                @foreach($onlyworkshop->values as $v)
            {
                id: {{$v->id}}, title: '{{$v->name}}'
            },
            @endforeach()

        ],
        events: [
                @foreach($onlyworkshop->values as $v)
            {
                allDay: false,
                daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                title: '{{$v->name }}',
                startTime: '{{$v->start}}+00:00',
                endTime: '{{$v->end}}+00:00',
                resourceId: {{$v->id}}
            },
            @endforeach()

        ]


    });
    calendar.render();
    $('#workshop').change(function () {
        console.log($(this).val())
        Livewire.emit('change')

    })
</script>
<div class="form-group col-sm-4">
    <label>选择车间:</label>

    <select id="workshop" class="form-control">

        @foreach($workshop as $d)
            <option value="{{$d['id']}}">{{$d['name']}}</option>
        @endforeach
    </select>
</div>
<div id='calendar'></div>
