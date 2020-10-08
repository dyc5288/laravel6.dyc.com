<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20
 * Time: 22:16
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $primaryKey = 'id';

    // 指定允许批量赋值的字段
    protected $fillable = ['name', 'age', 'sex'];

    // 指定不允许批量赋值的字段
    protected $guarded = [];

    // 自动维护时间戳
    public $timestamps = true;

    // 获取当前时间
    public function freshTimestamp() {
        return time();
    }

    // 自动维护时间的格式
    protected function getDataFormat()
    {
        return time();
    }

    // 避免转换时间戳为时间字符串
    public function fromDateTime($value) {
        return $value;
    }

    // 避免返回格式自动转换
    protected function asDateTime($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}