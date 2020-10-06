<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 基础路由
Route::get('test', function () {
    return 'test hello!';
});

Route::get('member/info', 'MemberController@info');

Route::get('member/info2', [
    'uses' => 'MemberController@info2',
    'as' => 'memberinfo'
]);

Route::get('member/info4', 'MemberController@info4');
Route::get('member/info5', 'MemberController@info5');

Route::any('member/{id}', [
    'uses' => 'MemberController@info3'
])->where('id', '[0-9]+');

Route::post('test2', function () {
    return 'test2 hello!';
});

// 多请求路由
Route::match(['post', 'get'], 'test3', function () {
    return 'test3 hello!';
});


Route::any('test4', function () {
    return 'test4 hello!';
});

// 路由参数
Route::get('user/{id}', function ($id) {
    return "test user id {$id}!";
});

Route::get('user/{name?}', function ($name = 'wang') {
    return "test user name {$name}!";
})->where('name', '[A-Za-z]+');

Route::get('user/{id}/{name?}', function ($id = 0, $name = 'wang') {
    return "test user name {$id}-{$name}!";
})->where(['id'=> '[0-9]+', 'name'=> '[A-Za-z]+']);

// 路由别名
Route::get('test5', ['as' => 'center', function () {
    return 'test hello!' . route('center');
}]);

// 路由群组
Route::group(['prefix' => 'yun'], function() {
    Route::any('test4', function () {
        return 'test4 yun hello!';
    });
    Route::get('test2', function () {
        return 'test2 yun hello!';
    });
});

// 路由中输出视图
Route::get('view', function () {
    return view('welcome');
});

Route::get('student', 'StudentController@index');
Route::get('student/db_insert', 'StudentController@db_insert');
Route::get('student/db_update', 'StudentController@db_update');
Route::get('student/db_delete', 'StudentController@db_delete');
Route::get('student/db_select', 'StudentController@db_select');
Route::get('student/db_sum', 'StudentController@db_sum');
Route::get('student/orm_select', 'StudentController@orm_select');
Route::get('student/orm_insert', 'StudentController@orm_insert');
Route::get('student/orm_update', 'StudentController@orm_update');
Route::get('student/orm_delete', 'StudentController@orm_delete');
Route::get('student/blade', 'StudentController@blade');
Route::any('url', ['as' => 'urlname', 'uses' => 'StudentController@url']);
Route::any('url2', ['uses' => 'StudentController@url2']);
Route::any('session1', ['uses' => 'StudentController@session1']);
Route::any('session2', ['uses' => 'StudentController@session2']);
Route::any('response', ['uses' => 'StudentController@response']);
Route::any('redirect', ['uses' => 'StudentController@redirect']);






