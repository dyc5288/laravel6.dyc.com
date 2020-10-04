<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/9
 * Time: 23:03
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    public function getMember()
    {
        return 'test get member';
    }
}