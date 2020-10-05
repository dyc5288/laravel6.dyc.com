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
use Illuminate\Support\Facades\DB;

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
     * 模版
     */
    public function url()
    {
        return '测试url';
    }

}