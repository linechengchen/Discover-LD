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
            locale: 'zh-cn',
            selectable: true,
            dateClick: function (info) {
                console.log(info)
                        $.ajax("/api/set_restday?look=1&work_shop_id="+{{$d['id']}}+"&restday="+info.dateStr+"&super_customer_id="+{{\Admin::user()->id}}).then(
                            function (data) {
                                if(data['type']==1){
                                    Dcat.confirm('设置今天为工作日？', info.dateStr, function () {
                                        $.ajax("/api/set_restday?del_id="+data.data.id).then(
                                            function (data1) {
                                                eval("calendar"+ {{$d['id']}}).refetchEvents();

                                            });
                                    });
                                }else{
                                    Dcat.confirm('设置今天为休息日？', info.dateStr, function () {
                                        $.ajax("/api/set_restday?work_shop_id=" + {{$d['id']}} + "&restday=" + info.dateStr + "&super_customer_id=" + {{\Admin::user()->id}}).then(
                                            function (data1) {
                                                eval("calendar"+{{$d['id']}}).refetchEvents();

                                            });
                                    });


                                }
                                // console.log(data.work_shop_id)
                                // calendar2.render();
                                // eval("calendar"+data.work_shop_id).render()
                });
                    // swal.fire({
                    //     title: 'Title',
                    //     html: "Some Text" +
                    //         "<br>" +
                    //         '<button type="button" role="button" tabindex="0" class="swal2-confirm swal2-styled">' + '' + '</button>' +
                    //         '<button type="button" role="button" tabindex="0" class="swal2-confirm swal2-styled">' + 'Button2' + '</button>',
                    //     showCancelButton: false,
                    //     showConfirmButton: false
                    // });

                // alert('Date: ' + info.dateStr);
                // alert('Resource ID: ' + info.resource.id);
            },
            // resources: { // you can also specify a plain string like 'json/resources.json'
            //     url: '/api/json/resources.json',
            //     failure: function () {
            //         document.getElementById('script-warning').style.display = 'block';
            //     }
            // },

            events: { // you can also specify a plain string like 'json/events-for-resources.json'
                url: '/api/getevents?workshop_id={{$d['id']}}',
                // failure: function () {
                //     document.getElementById('script-warning').style.display = 'block';
                // }
            }


        });
        @endforeach


            {{--$('div[id^=showcalendar]').hide(600);--}}
            {{--$("#showcalendar{{$workshop[0]->id}}").show(600)--}}
            calendar{{$workshop[0]->id}}.render()
            $("#workshop").change(function () {

                $('div[id^=showcalendar]').hide();
                $('#showcalendar'+$(this).val()).show();
                eval("calendar"+$(this).val()).render()
                // console.log($(this).val())
                // $('div[id^=showcalendar]').hide();
                // $('#showcalendar' + $(this).val()).show();
            })
        $(document).on('click', '.SwalBtn1', function() {
            //Some code 1
            console.log('Button 1');
            swal.clickConfirm();
        });
        $(document).on('click', '.SwalBtn2', function() {
            //Some code 2
            console.log('Button 2');
            swal.clickConfirm();
        });

    </script>

</head>
<body>
<div x-data="{ count: 0,workshop_id:{{$workshop[0]->id}},color:2 }">
    <div class="form-group col-sm-4">

        <select id="workshop" x-model="workshop_id" class="form-control">
            @foreach($workshop as $d)
                <option value="{{$d['id']}}">{{$d['name']}}</option>
            @endforeach
        </select>

    </div>
    @foreach($workshop as $d)
        <div id="showcalendar{{$d['id']}}">

            <div id='calendar{{$d['id']}}'></div>
        </div>
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
