<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    @section('css')
    @show
</head>
<body>
@include('index.layouts._header')
<div class="layui-container margin-top-lg">
    @section('body')
    @show
</div>
@include('index.layouts._footer')
@section('js')
    <script>
        layui.use(['layer', 'element'], function () {
            var layer = layui.layer;
            var element = layui.element;
            @include('index.layouts._error')
            @include('index.layouts._message')
        });
    </script>
@show
</body>
</html>