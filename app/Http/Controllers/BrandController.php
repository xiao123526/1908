<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Brand::get();
        return view('brand/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/create');
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
       if($request->hasFile('b_logo')){
        $data['b_logo']=$this->upload('b_logo');

       }
       $res=Brand::insert($data);
       if($res){
        return redirect('/brand');
       }
   }
    /**
     * 文件上传
     */
     public function upload($filename){
       // 判断上过程是否有误
       if(request()->file($filename)->isValid()){
            // 接收值
            $photo=request()->file($filename);
            // 上传
            $store_result=$photo->store('uploads');
            return $store_result;
       }
       exit('为获取到上传文件或上传过程错');
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
        // echo  $id;
        $data=Brand::find($id);
        return view('brand/edit',['data'=>$data]);
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
         if($request->hasFile('b_logo')){
        $data['b_logo']=$this->upload('b_logo');

       }
        $res=Brand::where('b_id',$id)->update($data);
        if($res){
            return redirect('brand');
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
        $res=Brand::destroy($id);
        if($res){
            return redirect('/brand');
}
        }
}
