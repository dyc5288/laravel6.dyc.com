@extends('common.layouts')

@section('title')
学生详情
@stop

@section('content')
    <div style="padding: 15px;">
        <table class="layui-table" style="width: 50%;">
            <colgroup>
                <col width="150">
                <col width="200">
            </colgroup>
            <tbody>
            <tr>
                <td style="text-align: center;" colspan="2">学生详情</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $student ? $student->id : '' }}</td>
            </tr>
            <tr>
                <td>姓名</td>
                <td>{{ $student ? $student->name : '' }}</td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>{{ $student ? $student->age : '' }}</td>
            </tr>
            <tr>
                <td>性别</td>
                <td>{{ $student ? $student->getSex($student->sex) : '' }}</td>
            </tr>
            <tr>
                <td>添加日期</td>
                <td>{{ $student ? $student->created_at : '' }}</td>
            </tr>
            <tr>
                <td>最后修改</td>
                <td>{{ $student ? $student->updated_at : '' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop


@section('javascript')
    // jquery初始化
    layui.use(['jquery'], function(){
        var $ = layui.$ //重点处
    });

    layui.use(['layer'], function(){
        var layer = layui.layer //重点处
    });

    //表单
    layui.use('form', function(){
        var form = layui.form;
    });

@stop