<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Admin;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        $data = Admin::paginate($pageSize);
        return view('admin/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'admin_name' => 'unique:admin|regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]{1,9}$/u',
            'password' => 'regex:/^[A-Za-z0-9]+$/',
            'admin_tel' => 'regex:/^\d{11}$/',
            'admin_email' => 'regex:/^www(\.)[A-Za-z0-9]{1,9}(\.)com$/',
        ],[
            'admin_name.unique'=>'用户名已存在',
            'admin_name.regex'=>'用户名必须由中文数字字母下划线组成且长度为一到九位',
            'password.regex'=>'密码有数字字母组成',
            'admin_tel.regex'=>'手机号必须为11位数字',
            'admin_email.regex'=>'邮箱格式有误',
        ]);
        if($validator->fails()){
            return redirect('admin/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        if($data['password']!=$data['passwords']){
            return redirect('/admin/create')->with('msg','此用户的密码两次不一致');
        }
        $data['password'] = encrypt($data['password']);
        unset($data['passwords']);
        $res = Admin::create($data);
        if($res){
            return redirect('admin/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::where('admin_id',$id)->first();
        return view('admin/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'admin_name' => [
                'regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]{1,9}$/u',
                Rule::unique('admin')->ignore($id,'admin_id'),
            ],
            'password' => 'regex:/^[A-Za-z0-9]+$/',
            'admin_tel' => 'regex:/^\d{11}$/',
            'admin_email' => 'regex:/^www(\.)[A-Za-z0-9]{1,9}(\.)com$/',
        ],[
            'admin_name.unique'=>'用户名已存在',
            'admin_name.regex'=>'用户名必须由中文数字字母下划线组成且长度为一到九位',
            'password.regex'=>'密码有数字字母组成',
            'admin_tel.regex'=>'手机号必须为11位数字',
            'admin_email.regex'=>'邮箱格式有误',
            'cate_id.regex'=>'商品分类必选',
            'goods_desc.required'=>'商品介绍必填',
        ]);
        if($validator->fails()){
            return redirect('admin/edit/'.$id)
                    ->withErrors($validator)
                    ->withInput();
        }
        $res = Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('admin/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Admin::where('admin_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'0000','msg'=>'yes']);
        }
    }
}
