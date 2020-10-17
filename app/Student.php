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
    const SEX_UNKNOWN = ''; // 未知
    const SEX_BOY = '1'; // 男
    const SEX_GIRL = '0'; // 女

    protected $table = 'student';
    protected $primaryKey = 'id';

    // 指定允许批量赋值的字段
    protected $fillable = ['name', 'age', 'sex', 'updated_at'];

    // 指定不允许批量赋值的字段
    protected $guarded = [];

    // 自动维护时间戳
    public $timestamps = true;

    // 获取当前时间
    public function freshTimestamp() {
        return time();
    }

    /**
     * 获取性别
     * @param null $sexId
     * @return array|mixed
     */
    public function getSex($sexId = null)
    {
        $data = [
            self::SEX_UNKNOWN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女'
        ];

        if ($sexId === null)
        {
            return $data;
        }

        return array_key_exists($sexId, $data) ? $data[$sexId] : $data[self::SEX_UNKNOWN];
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