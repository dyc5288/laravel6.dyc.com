<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/7
 * Time: 21:31
 */
namespace App\Http\Controllers;

use app\Member;

class  MemberController extends Controller {

    /**
     * 返回成员信息
     */
    public function info() {
        //$memberModel = new Member();
        return 'test';
    }

    /**
     * 返回成员信息
     */
    public function info2() {
        return 'member||info2:' . route('memberinfo');
    }

    /**
     * 返回成员信息
     */
    public function info3($id) {
        return 'member-info:' . $id;
    }

    /**
     * 返回成员信息
     */
    public function info4() {
        return view('member-info');
    }

    /**
     * 返回成员信息
     */
    public function info5() {
        return view('member/info', [
            'name' => '云朝',
            'age' => 19
        ]);
    }
}