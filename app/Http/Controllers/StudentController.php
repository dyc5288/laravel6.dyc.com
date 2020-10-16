<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/9
 * Time: 23:32
 */

namespace App\Http\Controllers;

use App\Member;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{

    public function index()
    {
        $students = DB::select("select * from student");
        dd($students);

        //$res = DB::insert('insert into student(name, age) values (?, ?)', ['李四', 112]);
        //var_dump($res);

        //$res = DB::update('update student set age = ? where name = ?', [111, '李四']);
        //var_dump($res);

        $res = DB::delete('delete from student where name = ?', ['李四']);
        var_dump($res);
    }

    /**
     * 数据库构造器插入数据
     */
    public function db_insert()
    {
        $res = DB::table('student')->insert(['name' => '小白', 'age' => 24]);
        var_dump($res);

        $id = DB::table('student')->insertGetId(['name' => '小黑', 'age' => 30]);
        var_dump($id);

        $res = DB::table('student')->insert([
            ['name' => '小亮', 'age' => 25],
            ['name' => '小王', 'age' => 26]
        ]);
        var_dump($res);
    }

    /**
     * 数据库构造器更新数据
     */
    public function db_update()
    {
        $res = DB::table('student')
            ->where('id', 105)
            ->update(['age' => 35]);
        var_dump($res);

        $res = DB::table('student')
            ->where('id', 104)
            ->increment('age', 2);
        var_dump($res);

        $res = DB::table('student')
            ->where('id', 103)
            ->decrement('age', 3, ['name' => '小黑兵']);
        var_dump($res);
    }

    /**
     * 数据库构造器删除数据
     */
    public function db_delete()
    {
        $res = DB::table('student')
            ->where('id', 105)
            ->delete();
        var_dump($res);

        $res = DB::table('student')
            ->where('id', '<=', 102)
            ->delete();
        var_dump($res);

        DB::table('student')->truncate();
    }

    /**
     * 数据库构造器查询数据
     */
    public function db_select()
    {
        $res = DB::table('student')->get();
        //dd($res);

/*        $res = DB::table('student')
            ->orderBy('id', 'desc')
            ->first();*/
        //dd($res);

        $res = DB::table('student')
            ->where('id', '>=', 10)
            ->get();
        //dd($res);

        $res = DB::table('student')
            ->whereRaw('id >= ? and age >= ?', [10, 26])
            ->get();
        //dd($res);

        $res = DB::table('student')
            ->whereRaw('id >= ? and age >= ?', [10, 26])
            ->pluck('name');
        //dd($res);

        echo '<pre>';
        DB::table('student')
            ->orderBy('id', 'desc')
            ->chunk(5, function ($res){
            var_dump($res);
            return false; // 返回false则退出
        });
    }

    /**
     * 数据库构造器查询数据
     */
    public function db_sum()
    {
        $res = DB::table('student')->count();
        var_dump($res);

        $res = DB::table('student')->max('age');
        var_dump($res);

        $res = DB::table('student')->min('age');
        var_dump($res);

        $res = DB::table('student')->avg('age');
        var_dump($res);

        $res = DB::table('student')->sum('age');
        var_dump($res);
    }

    /**
     * 数据库ORM查询数据
     */
    public function orm_select()
    {
        $res = Student::all();
        //dd($res);

        $res = Student::find(10);
        //dd($res);

        $res = Student::findOrFail(10);
        //dd($res);

        $res = Student::where('id', '>', '10')
            ->orderBy('age', 'desc')
            ->first();
        //dd($res);

        echo "<pre>";
        Student::chunk(5, function ($students){
            //var_dump($students);
        });

        $res = Student::count();
        //dd($res);

        $res = Student::max('age');
        dd($res);
    }

    /**
     * 数据库ORM插入数据
     */
    public function orm_insert()
    {
        $student = new Student();
        $student->name = '4六';
        $student->age = '11';
        $student->updated_at = time();
        $student->created_at = time();
        //$res = $student->save();
        //dd($res);

        $student = Student::find('15');
        echo date('Y-m-d H:i:s', $student->updated_at);

        //$student = Student::create(['name' => '小天', 'age' => 35]);
        //dd($student);

        // 不存在自动保存
        //$student = Student::firstOrCreate(['name' => '小天2']);
        //dd($student);

        // 不存在手动保存
        $student = Student::firstOrNew(['name' => '小天4']);
        //$res = $student->save();
        //dd($res);
    }

    /**
     * 数据库ORM更新数据
     */
    public function orm_update()
    {
        $student = Student::find('13');
        $student->age = 56;
        //$res = $student->save();
        //dd($res);

        $res = Student::where('id', '>', 13)->update(['age' => 80]);
        dd($res);
    }

    /**
     * 数据库ORM删除数据
     */
    public function orm_delete()
    {
        $student = Student::find('13');
        //$res = $student->delete();
        //dd($res);

        //$res = Student::destroy(16);
        //$res = Student::destroy(16, 17);
        //$res = Student::destroy([16, 17]);
        //dd($res);

        $res = Student::where('id', '>', 13)->delete();
        dd($res);
    }

    /**
     * 模版
     */
    public function blade()
    {
        $data = [
            'name' => '张四',
            'allName' => ['张三', '李四']
        ];
        return view('student.test', $data);
    }

    /**
     * url测试
     *
     * @param Request $request
     *
     * @return string
     */
    public function url(Request $request)
    {
        $name = $request->input('name');
        echo "name: {$name}<br>";
        if ($request->has('age')) {
            $age = $request->input('age');
            echo "age: {$age}<br>";
        }
        echo "全部参数:<br>";
        var_dump($request->all());
        echo "<br>";
        $method = $request->method();
        echo "method: {$method}<br>";
        if ($request->isMethod('GET')) {
            echo "GET请求<br>";
        }
        if ($request->ajax()) {
            echo "ajax请求<br>";
        }
        if ($request->is("url*")) {
            echo "url路由<br>";
        }
        $url = $request->url();
        echo "url: {$url}<br>";
        return '测试url';
    }

    /**
     * post请求
     *
     * @param Request $request
     *
     * @return string
     */
    public function url2(Request $request)
    {
        return $this->url($request);
    }

    /**
     * session写入
     * @param Request $request
     */
    public function session1(Request $request)
    {
        // http的 Request
        $session = $request->session();
        $session->put('test1', 'value1');
        // session()
        session()->put('test2', 'value2');
        // Session
        Session::put('test3', 'value3');
        // push
        Session::push('student', '张三');
        Session::push('student', '李四');
        // flash
        Session::flash('flasha', 'fv1');
    }

    /**
     * session读取
     * @param Request $request
     */
    public function session2(Request $request)
    {
        //Session::flush();
        $value = $request->session()->get('test1');
        $value2 = session()->get('test2');
        $value3 = session()->get('test3');
        $all = Session::all();
        $value5 = Session::pull('student', '默认');
        $value4 = session()->get('student');
        $value6 = session()->has('test4');
        Session::forget('test2');
        $value7 = Session::get('flasha');
        dd([$value, $value2, $value3, $all, $value4, $value5, $value6, $value7]);
    }

    /**
     * 响应json
     */
    public function response()
    {
        $message = Session::get('message');
        $data = [
            'state' => 0,
            'code' => 14141,
            'message' => intval($message),
            'data' => [
                'name' => '张三'
            ]
        ];
        dd($data);
        return response()->json($data);
    }

    /**
     * 重定向
     * @param Request $request
     */
    public function redirect(Request $request)
    {
        $type = $request->input('type', 0);
        switch ($type)
        {
            case 0:
                return redirect('response')->with('message', '12313');
            case 1:
                return redirect()->route('urlname');
            case 2:
                return redirect()->back();
            default:
                return redirect()->action('StudentController@session2');
        }
    }

    /**
     * 活动准备前
     * @return string
     */
    public function activity0()
    {
        return '活动还未开始，敬请期待';
    }

    /**
     * 活动开始中
     * @return string
     */
    public function activity1()
    {
        return '活动一正在进行中';
    }

    /**
     * 活动二
     * @return string
     */
    public function activity2()
    {
        return '活动二正在进行中';
    }

    /**
     * 首页列表
     */
    public function main()
    {
        //$students = Student::get();
        $students = Student::paginate(7);
        return view('student.index', [
            'students' => $students
        ]);
    }

    /**
     * 添加和编辑
     * @param Request $request
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $validate = $request->input('validate');
            switch ($validate)
            {
                case '1':
                    $this->validate($request, [
                            'Student.name' => 'required|min:2|max:20',
                            'Student.age' => 'required|integer',
                            'Student.sex' => 'required|integer'
                        ], [
                            'required' => ':attribute为必选项',
                            'min' => ':attribute长度不符合要求',
                            'max' => ':attribute长度不符合要求',
                            'integer' => ':attribute必须为整数',
                        ], [
                            'Student.name' => '姓名',
                            'Student.age' => '年龄',
                            'Student.sex' => '性别'
                        ]
                    );
                    break;
                case '2':
                    $validator = \Validator::make(
                        $request->input(),[
                            'Student.name' => 'required|min:2|max:20',
                            'Student.age' => 'required|integer',
                            'Student.sex' => 'required|integer'
                        ], [
                            'required' => ':attribute为必选项',
                            'min' => ':attribute长度不符合要求',
                            'max' => ':attribute长度不符合要求',
                            'integer' => ':attribute必须为整数',
                        ], [
                            'Student.name' => '姓名',
                            'Student.age' => '年龄',
                            'Student.sex' => '性别'
                        ]
                    );
                    if ($validator->fails())
                    {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    break;
            }

            $data = $request->input('Student');

            if (Student::create($data))
            {
                return redirect('student/index')->with('success', '添加成功！');
            }
            else
            {
                return redirect()->back();
            }
        }

        $student = new Student();
        $data = ['student' => $student];
        return view('student.edit', $data);
    }

    /**
     * 保存
     * @param Request $request
     */
    public function save(Request $request)
    {
        $data = $request->input('Student');
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save())
        {
            return redirect('student/index')->with('success', '添加成功！');
        }
        else
        {
            return redirect()->back();
        }
    }

}