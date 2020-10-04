@extends('layout')

@section('header')
    @parent
    增加头部
    @parent
@stop

@section('content')
    替换内容
@stop

@section('sidebar')
    替换边栏 {{ $name }}
    <p>
        {{ time() }}
    </p>
    <p>
        {{ date('Y-m-d', time()) }}
    </p>
    <p>
        {{ date('Y-m-d', time()) }}
    </p>
    <p>
        {{ in_array($name, $allName) ? '存在' : '不存在'}}
    </p>
    <p>
        {{ var_dump('test') }}
    </p>
    <p>
        {{ isset($name) ? $name : '默认' }}
    </p>
    <p>
        {{ isset($name1) ? $name1 : '默认' }}
    </p>
    <p>
        @{{ isset($name1) ? $name1 : '默认' }}
    </p>
    <p>
        <!-- html的注释 -->
        {{-- 模版注释 --}}
    </p>
    <p>
        @include('student.common', ['message' => 'test'])
    </p>
@stop