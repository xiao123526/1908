<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=request()->type??'';
        $tname=request()->tname??'';
         $where=[];
         if($type){
            $where[]=['type','like',"%$type%"];
         }
         if($tname){
            $where[]=['tname','like',"%$tname%"];
         }
        $pageSize=config('app.pageSize');
        $data=Title::where($where)->orderby('tid','desc')->paginate($pageSize);

        // dd($data);die;
        return view('title.index',['data'=>$data,'type'=>$type,'tname'=>$tname]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=$request->except('_token');
        // 判断有误文件被上传
        if($request->hasFile('timg')){
            $data['timg']=$this->upload('timg');
        }
        $data['add_time']=time();
        $res=Title::insert($data);
        if($res){
            return redirect('/title');
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
    public function edit($id)
    {
        $data=Title::find($id);
        // dd($data);

        return view('title.edit',['data'=>$data]);
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
       $data=$request->except('_token');
          // 判断有误文件被上传
        if(request()->hasFile('timg')){
            $data['timg']=$this->upload('timg');
        }
       $res=Title::where('tid',$id)->update($data);
       if($res!==false){
            return redirect('title');
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
        $res=Title::destroy($id);
        if($res){
            echo json_encode(['code'=>'000000','mag'=>'ok']);
        }

    }
    /**
     * 文章标题唯一性验证
     */
    public function checkOnly(){
        $title=request()->title;
        // dd($title);
        $count=Title::where(['tname'=>$title])->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
}
