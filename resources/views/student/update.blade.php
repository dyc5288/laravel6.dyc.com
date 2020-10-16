@extends('common.layouts')

@section('title')
编辑学生
@stop

@section('content')
    <div style="padding: 15px;">
        @include('student.form')
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
        //监听提交
        /*form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });*/
    });

@stop