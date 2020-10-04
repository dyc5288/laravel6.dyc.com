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

    // ָ������������ֵ���ֶ�
    protected $fillable = ['name', 'age'];

    // ָ��������������ֵ���ֶ�
    protected $guarded = [];

    // �Զ�ά��ʱ���
    public $timestamps = true;

    // ��ȡ��ǰʱ��
    public function freshTimestamp() {
        return time();
    }

    // �Զ�ά��ʱ��ĸ�ʽ
    protected function getDataFormat()
    {
        return time();
    }

    // ����ת��ʱ���Ϊʱ���ַ���
    public function fromDateTime($value) {
        return $value;
    }

    // ���ⷵ�ظ�ʽ�Զ�ת��
    protected function asDateTime($value)
    {
        return $value;
    }
}