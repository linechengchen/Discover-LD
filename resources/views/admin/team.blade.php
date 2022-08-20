<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script type="javascript" src="{{asset('static/fullcalendar-scheduler-5.11.2/lib/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('static/fullcalendar-scheduler-5.11.2/lib/main.css')}}"
          crossorigin="anonymous">
    <script src="{{asset('static/fullcalendar-scheduler-5.11.2/lib/locales/zh-cn.js')}}"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->

    @livewireStyles
</head>

<body>
@livewire('teamcalendar')
@livewireScripts
</body>
<style>

</style>

</html>
