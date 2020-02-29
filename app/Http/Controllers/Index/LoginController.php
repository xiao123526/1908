<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
class LoginController extends Controller
{
    /**
     * 显示登录的视图
     */
    public function login(){
        return view('index/login');
    }
    /**
     * 登录的执行页面
     */
    public function loginDo(){
        // 接收form表单传过来的值
        $data=request()->except('_token');
        // dd($data);die;
        $res=Member::where('mobile','=',$data['mobile'])->first();
        $pwd=decrypt($res['pwd']);
         if($data['pwd']==$pwd){
            // session('userInfo',$data);

            return redirect('prolist');
         }

    }
}
