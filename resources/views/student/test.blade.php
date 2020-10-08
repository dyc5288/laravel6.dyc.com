@extends('layout')

@section('header')
    @parent
    增加头部
    @parent
    @if($name == '张三')
        我是张三
    @elseif($name == '张四')
        我应该是张四
    @else
        我是谁
    @endif

    @unless($name != '张四')
        我其实是张四
        @if($name == '张四')
            的却是张四
        @endif
    @endunless

    @for($i = 0; $i < 8; $i++)
        <{{ $i }}>
    @endfor

    @foreach($allName as $name)
        <{{ $name }}>
    @endforeach

    @forelse($allName as $name)
        ||<{{ $name }}>
    @empty
        null
    @endforelse

    <br>
    <a target="_blank" href="{{ url('url') }}">url方法</a>
    <br>
    <a target="_blank" href="{{ action('StudentController@url') }}">action方法</a>
    <br>
    <a target="_blank" href="{{ route('urlname') }}">route方法</a>
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