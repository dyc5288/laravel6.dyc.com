@extends('common.layouts')

@section('title')
首页
@stop

@section('content')
    <div style="padding: 15px;">
        学生列表
        <table class="layui-table">
            <colgroup>
                <col width="100">
                <col width="200">
                <col width="100">
                <col width="100">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>张三</td>
                <td>12</td>
                <td>男</td>
                <td>2016-11-29</td>
                <td>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe63c;</i>
                    </button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe642;</i>
                    </button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe640;</i>
                    </button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>李四</td>
                <td>18</td>
                <td>女</td>
                <td>2019-11-29</td>
                <td>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe63c;</i>
                    </button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe642;</i>
                    </button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary">
                        <i class="layui-icon">&#xe640;</i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="page" id="page"></div>
    </div>
@stop


@section('javascript')
    layui.use(['jquery'], function(){
        var $ = layui.$ //重点处
        $("#studentIndex").addClass("layui-this");
    });

    layui.use('laypage', function(){
        var laypage = layui.laypage;

        //执行一个laypage实例
        laypage.render({
            elem: 'page' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: 50 //数据总数，从服务端得到
        });
    });

@stop