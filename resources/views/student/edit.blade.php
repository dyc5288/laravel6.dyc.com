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
                    <input id="StudentName" type="text" value="{{ old('Student') ? old('Student')['name'] : '' }}"
                           name="Student[name]" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">* <span style="color: red;">{{ $errors->first('Student.name') }}</span></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">年龄</label>
                <div class="layui-input-inline">
                    <input id="StudentAge" type="text" value="{{ old('Student') ? old('Student')['age'] : '' }}"
                           name="Student[age]" placeholder="请输入年龄" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">* <span style="color: red;">{{ $errors->first('Student.age') }}</span></div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block"  id="StudentSex">
                    @foreach($student->getSex() as $sexId => $sexName)
                        @php
                            $sexId = strval($sexId);
                            $oldSexId = strval(old('Student')['sex']);
                        @endphp
                        <input type="radio" name="Student[sex]" value="{{ $sexId }}" title="{{ ($sexId === '') ? '请选择性别' : $sexName }}"
                                {{ old('Student') ? ($oldSexId === $sexId ? 'checked' : '') : ($sexId === '' ? 'checked' : '') }}>
                    @endforeach
                    <span style="color: red;">{{ $errors->first('Student.sex') }}</span>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <input type="hidden" name="validate" value="2">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                </div>
            </div>
            @include('common.validator')
        </form>
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