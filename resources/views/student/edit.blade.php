@extends('common.layouts')

@section('title')
编辑
@stop

@section('content')
    <div style="padding: 15px;">
        <form class="layui-form" method="post" action="">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-inline">
                    <input type="text" name="Student[name]" required  lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">*</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">年龄</label>
                <div class="layui-input-inline">
                    <input type="text" name="Student[age]" required lay-verify="required" placeholder="请输入年龄" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">*</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="Student[sex]" value="1" title="男">
                    <input type="radio" name="Student[sex]" value="0" title="女" checked>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                </div>
            </div>
        </form>
    </div>
@stop


@section('javascript')
    // jquery初始化
    layui.use(['jquery'], function(){
        var $ = layui.$ //重点处
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