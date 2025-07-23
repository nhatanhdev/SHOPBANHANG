<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    @yield('title')
    <link rel="icon" href="{{asset(Setting_key('fanvicon'))}}" sizes="32x32" type="image/png">
    @include('admin.partials.css')

</head>

<body class="crm_body_bg">

    @include('admin.partials.sidebar')

    <section class="main_content dashboard_part">

        @include('admin.partials.header')

        @yield('content')
        @include('admin.partials.loading')
        @include('admin.partials.modal_loading')

        @include('admin.partials.footer')
    </section>



    @include('admin.partials.script')

</body>


</html>
