<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;//门面
use Illuminate\Validation\Rule;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 搜索
        $username=request()->username??'';
        $where=[];
        if($username){
            $where[]=['username','like',"%$username%"];
        }
        // $data=DB::table('people')->get();
        // 分页
        $pageSize=config('app.pageSize');
        $data=people::where($where)->orderby('p_id','desc')->paginate($pageSize);;
        return view('people/index',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 第二种
    public function store(StorePeoplePost $request)
    // public function store(Request $request)
    {
        // 第一种验证
        $request->validate([
                'username'=>'required|unique:people|max:12|min:2',
                'age'=>'required|integer|between:1,130',
            ],[
                'username.required'=>'名字不能为空',
                'username.unique'=>'名字已存在',
               'username,max'=>'名字最大长度支持12位',
                'username.min'=>'名字最小长度支持2位',
                'age.required'=>'年龄不能为空',
                // 'age.integer'=>'年龄必须为数字',
                // 'age.min'=>'年龄规范不合法',
                // 'age.max'=>'年龄规范不合法',

            ]);
       $data = $request->except('_token');
       $data['add_time']=time();
       // 第三种验证   手动创建控制器
       // $validator=Validator::make($data,[
       //           'username'=>'unique:people|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
       //          'age'=>'required|integer|min:1|max:3',
       //  ],[
       //          'username.unique'=>'名字已存在',
       //          'username.regex'=>'名字必须有由数字、字母、下划线2-12位组成',
       //          'age.required'=>'年龄不能为空',
       //          'age.integer'=>'年龄必须为数字',
       //          'age.min'=>'年龄规范不合法',
       //          'age.max'=>'年龄规范不合法',
       //  ]);
       // if($validator->fails()){
       //      // 判断表单验证信息是否有误  如果有误的话
       //      return redirect('people/create')
       //      ->withErrors($validator)
       //      ->withInput();
       // }
       // 判断有误文件上传
       if($request->hasFile('head')){
         $data['head']=$this->upload('head');
         // dd($img);
       }
       // $res=DB::table('people')->insert($data);
       $res=people::insert($data);
    if($res){
        return redirect('/people');
        }
    }
    /**
     * 文件上传
     */
    public function upload($filename){
        // 判断上传过程是否有误
        if(request()->file($filename)->isValid()){
        // 接收值
        $photo=request()->file($filename);
        // 上传
        $store_result=$photo->store('uploads');
        return $store_result;
    }
    exit('为获取到上传文件或上传过程出');

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
    public function edit($p_id)
    {
        // $user=DB::table('people')->where('p_id',$p_id)->first();
        $user=people::find($p_id);
        return view('people/edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePeoplePost $request, $id)
    {
        $user=$request->except('_token');
        // 验证
         $validator=Validator::make($user,[
                 'username'=>[
                                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                                 Rule::unique('people')->ignore($id,'p_id'),
                                ],
                'age'=>'required|integer|between:1,130',
        ],[
                'username.unique'=>'名字已存在',
                'username.regex'=>'名字必须有由数字、字母、下划线2-12位组成',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄必须为数字',
                'age.between'=>'年龄规范不合法',
                // 'age.max'=>'年龄规范不合法',
        ]);
       if($validator->fails()){
            // 判断表单验证信息是否有误  如果有误的话
            return redirect('people/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
       }
        // 判断是否有文件被上传
        if($request->hasFile('head')){
            $user['head']=$this->upload('head');
        }
        // $res=DB::table('people')->where('p_id',$id)->update($user);
        $res=people::where('p_id',$id)->update($user);
        if( $res !==false){
            return redirect('/people');
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
        // echo $id;
        // $res=DB::table('people')->where('p_id',$id)->delete();
        $res=people::destroy($id);
        if($res){
            return redirect('/people');
        }
    }
}
