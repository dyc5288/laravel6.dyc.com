<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>管理后台 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/layui/css/layui.css') }}">
    @section('header')
    @show
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">管理后台 - @yield('title')</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">

        </ul>
        <ul class="layui-nav layui-layout-right">

        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            @section('menu')
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">学生</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">学生列表</a></dd>
                        <dd><a href="javascript:;">新增学生</a></dd>
                    </dl>
                </li>
            </ul>
            @show
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        @yield('content')
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        @section('footer')
        © laravel.dyc.com - 学习
        @show
    </div>
</div>
<script src="{{ asset('assets/layui/layui.js') }}"></script>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
</script>
</body>
</html>