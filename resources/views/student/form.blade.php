<form class="layui-form" method="post" action="">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline">
            <input id="StudentName" type="text" value="{{ old('Student') ? old('Student')['name'] : $student->name }}"
                   name="Student[name]" placeholder="请输入姓名" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">* <span style="color: red;">{{ $errors->first('Student.name') }}</span></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input id="StudentAge" type="text" value="{{ old('Student') ? old('Student')['age'] : $student->age }}"
                   name="Student[age]" placeholder="请输入年龄" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">* <span style="color: red;">{{ $errors->first('Student.age') }}</span></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        @php
            $oldSexId = old('Student') ? strval(old('Student')['sex']) : '';
            $currSexId = strval($student->sex);
        @endphp
        <div class="layui-input-block"  id="StudentSex">
            @foreach($student->getSex() as $sexId => $sexName)
                @php
                    $sexId = strval($sexId);
                @endphp
                <input type="radio" name="Student[sex]" value="{{ $sexId }}" title="{{ ($sexId === '') ? '请选择性别' : $sexName }}"
                        {{ old('Student') ? ($oldSexId === $sexId ? 'checked' : '') : ($sexId === $currSexId ? 'checked' : '') }}>
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