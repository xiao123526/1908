<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config('app.pageSize');
        $cate_data=Category::paginate($pageSize);
        return view('category/index',['cate_data'=>$cate_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Category::get();

        $p_data=createTree($data);

        return view('category/create',['p_data'=>$p_data]);
        // return view('category.create');
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
       $res=Category::insert($data);
       if($res){
          return redirect('/category');
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
         $p_data=Category::get();
         $data=Category::find($id);
         // dd($data);
        return view('category/edit',['p_data'=>$p_data,'data'=>$data]);
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
        $res=Category::where('cate_id',$id)->update($data);
        if($res!==false){
            return redirect('/category');
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
        $res=Category::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','mag'=>'pk']);
        }
    }
    // 唯一性验证
    public function checkOnly(){
        $cate_name=request()->cate_name;
        // $where=[];
        // if($cate_name){
        //     $where[]=['cate_name','=',$cate_name];
        // }
        // $id=request()->id;
        // if($id){
        //     $where[]=['cate_id','=',$id];
        // }
        // $count=Category::where($where)->count();
        $count=Category::where(['cate_name'=>$cate_name])->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }

}
