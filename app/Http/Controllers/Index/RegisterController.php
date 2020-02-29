<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Member;
class RegisterController extends Controller
{
    /**
     * 显示注册的视图
     * @return [type] [description]
     */
    public function register(){
        return view('index/reg');
    }
    /**
     * 接收注册的数据  注册执行
     */
    public function registerDo(){
        $code=session('code');
        $data=request()->except('_token');
        // 判断验证码是否正确
        if($code!=$data['code']){
            return redirect('reg')->with('msg','您输入的验证码有误');
        }
        // 判断密码与确认密码是否一致
        if($data['pwd']!=$data['repwd']){
            return redirect('reg')->with('msg','确认密码请与密码保持一致');
        }
        $data['add_time']=time();
        $data['pwd']=encrypt($data['pwd']);
        $data['repwd']=encrypt($data['repwd']);
        // 入库
        $res=Member::insert($data);
        if($res){
            return redirect('login');
        }

    }
    /**
     * 短信发送
     * @return [type] [description]
     */
      public function ajaxsend(){
        //接受注册页面的手机号
        // $mobile = '15227932387';
        $mobile=request()->mobile;
        // $moblie = request()->mobile;
        $code = rand(1000,9999);
        $res = $this->sendSms($mobile,$code);
        // print_r($res);exit;
        if( $res['Code']=='OK'){
            session(['code'=>$code]);
            request()->session()->save();

          echo json_encode(['code'=>'00000']);
        }else{
          echo json_encode(['code'=>'00001']);
        }

    }
    /**
     * 短信发送
     */

    public function sendSms($mobile,$code){

        AlibabaCloud::accessKeyClient('LTAI4FeWAwpi3QYvw9amK7Nn','OZ9O7CR1J5SyjtaL1rheytgW4vM3uP')
                                    ->regionId('cn-hangzhou')
                                    ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                                      ->product('Dysmsapi')
                                      // ->scheme('https') // https | http
                                      ->version('2017-05-25')
                                      ->action('SendSms')
                                      ->method('POST')
                                      ->host('dysmsapi.aliyuncs.com')
                                      ->options([
                                                    'query' => [
                                                      'RegionId' => "cn-hangzhou",
                                                      'PhoneNumbers' => $mobile,
                                                      'SignName' => "小不点php学习",
                                                      'TemplateCode' => "SMS_181210780",
                                                      'TemplateParam' => "{code:$code}",
                                                    ],
                                                ])
                                      ->request();
                return $result->toArray();
            } catch (ClientException $e) {
                return $e->getErrorMessage();
            } catch (ServerException $e) {
                return $e->getErrorMessage();
            }
    }
}
