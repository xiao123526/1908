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
// 闭包路由
// Route::get('/', function () {
//     $name='1908欢迎你';
//     return view('welcome',['name'=>$name]);
//     // echo  123;
// });

// 1：实现两种方式访问http://www.1908.com/show 输出“这里是商品详情页”字样
// Route::get('/show', function(){
//     echo "这里是商品详情页";
// });
// Route::view('show','user.show');
// 2：访问http://www.1908.com/show/1 输出“商品Id是：1”字样
// Route::get('/show1/{goods_id}',function($goods_id){
//     echo $goods_id;
// });
//
// 3：访问http://www.1908.com/show/23/裤子 输出“商品Id是：23，关键字是：裤子”字样
// Route::get('/show/{goods_id}/{name}',function($goods_id,$name){
//     echo "商品id是"."$goods_id"."关键字是"."$name";
// });
//
// 4：实现两种方式访问http://www.1908.com/brand/add显示添加界面
// Route::view('/brand/add','user/add');
// Route::get('/branddo','UserController@index')->name('brand');
// 5：实现访问http://www.1908.com/category/add显示添加分类界面，并带过去参数 变量 fid=“服装”;
Route::get('/category/add',function(){
    $find="服饰";
    return view('user/add',['find'=>$find]);
});
// 正则约束
Route::get('goods/{goods_id}/{name}',function($goods_id,$name){
    echo "商品id";
    echo $goods_id;
    echo  "商品名称";
    echo $name;
})->where(['goods_id'=>'\d+','name'=>'[a-z]+']);
// 湖北务工人员统计信息
// 路由前缀(prefix 前缀 group 分组)
Route::prefix('people')->middleware('checkLogin')->group(function(){
    Route::get('create','PeopleController@create');
    Route::post('store','PeopleController@store')->name('store');
    Route::get('/','PeopleController@index');
    Route::get('edit/{id}','PeopleController@edit');
    Route::post('update/{id}','PeopleController@update');
    Route::get('destroy/{id}','PeopleController@destroy');
});
// Route::get('/login','LoginController@create');
// Route::post('login/store','LoginController@store');

// 学生表的增删改查
Route::get('student/create','StudentController@create');
Route::post('student/store','StudentController@store');
Route::get('student','StudentController@index');
Route::get('student/deit/{id}','StudentController@edit');
Route::post('student/update/{id}','StudentController@update');
Route::get('student/destroy/{id}','StudentController@destroy');
// 品牌名称的增删改查
Route::get('brand/create','BrandController@create');
Route::post('brand/store','BrandController@store');
Route::get('brand','BrandController@index');
Route::get('brand/edit/{id}','BrandController@edit');
Route::post('brand/update/{id}','BrandController@update');
Route::get('brand/destroy/{id}','BrandController@destroy');
// 文章的增删查改
Route::prefix('title')->middleware('checkLogin')->group(function(){
    Route::get('create','TitleController@create');
      Route::get('/','TitleController@index');
    Route::post('store','TitleController@store');
    Route::get('edit/{id}','TitleController@edit');
   Route::post('update/{id}','TitleController@update');
    Route::get('destroy/{id}','TitleController@destroy');
    Route::post('checkOnly','TitleController@checkOnly');

});
// Route::get('/login','LoginController@create');
// Route::post('login/store','LoginController@store');


// 商品分类表的增删改查
Route::prefix('category')->group(function(){
    Route::get('create','CategoryController@create');
    Route::post('store','CategoryController@store');
    Route::get('/','CategoryController@index');
    Route::post('checkOnly','CategoryController@checkOnly');
    Route::get('destroy/{id}','CategoryController@destroy');
    Route::get('edit/{id}','CategoryController@edit');
    Route::post('update/{id}','CategoryController@update');
});
// 商品表的增删改查
Route::prefix('goods')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store');
    Route::get('/','GoodsController@index');
});
// 管理员
Route::prefix('admin')->group(function(){
    Route::get('create','AdminController@create');
    Route::post('store','AdminController@store');
    Route::get('index','AdminController@index');
    Route::get('destroy/{id}','AdminController@destroy');
    Route::get('edit/{id}','AdminController@edit');
    Route::post('update/{id}','AdminController@update');
});
// 前台
Route::get('/','Index\IndexController@index');
Route::get('login','index\LoginController@login');
Route::get('reg','index\RegisterController@register');
Route::get('send','Index\RegisterController@ajaxsend');
Route::post('registerDo','Index\RegisterController@registerDo');
Route::post('loginDo','Index\LoginController@loginDo');
Route::get('prolist','Index\IndexCOntroller@prolist');
Route::get('/index/proinfo/{id}','Index\IndexController@proinfo');
