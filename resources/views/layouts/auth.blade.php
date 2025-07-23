<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @yield('title')
    <link rel="icon" href="{{asset(Setting_key('fanvicon'))}}" type="image/png">
    @include('admin.partials.css')



</head>

<body class="crm_body_bg">




    <section class="main_content dashboard_part" style="padding-left: 0px;">

        @yield('content')

    </section>


    @include('admin.partials.script')




</body>


</html>
