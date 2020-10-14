@if (count($errors))
    <div class="layui-form-item">
        <div class="layui-input-block" id="error-message" style="color: red;">
            {{ $errors->first() }}
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block" id="errors-message" style="color: red;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif