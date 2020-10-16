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
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->getSex($student->sex) }}</td>
                    <td>{{ $student->created_at }}</td>
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
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $students->render() }}
        </div>
    </div>
@stop


@section('javascript')
    // jquery初始化
    layui.use(['jquery'], function(){
        var $ = layui.$ //重点处
    });

    // 分页
    /*layui.use('laypage', function(){
        var laypage = layui.laypage;

        //执行一个laypage实例
        laypage.render({
            elem: 'page' //注意，这里的 test1 是 ID，不用加 # 号
            ,count: 50 //数据总数，从服务端得到
        });
    });*/

    // 弹窗
    layui.use('layer', function(){
        var layer = layui.layer;
        @if (Session::has('success'))
            layer.msg('{{ Session::get('success') }}', {icon: 1});
        @endif
        //layer.msg('已存在该名字！', {icon: 2});
        //layer.msg('保存成功！', {icon: 1});
        //layer.load(1);
        //layer.alert('酷毙了', {icon: 5});
    });

@stop