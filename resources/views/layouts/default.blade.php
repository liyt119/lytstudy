<!DOCTYPE html>
<html>

<head>
    <title>@yield('title','信息展示')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('type')

    <!--Styles-->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
</head>

<body>
    <div>
        @include('layouts._header')


        @yield('content')
        @yield('script')






        @include('layouts._footer')

    </div>
</body>

</html>