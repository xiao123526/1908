<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
// use App\Helpers\funtion.php;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 从缓存中取值
        // $data=Cache::get('data');
        //全局辅助函数  从缓存中取值 cache('名字（键名）');
        // $data=cache('data');
        // Redis::flushall();
        $data=Redis::get('data');
        // dd($data);
        if(!$data){
            // echo "走Db";
            // 如果缓存中没有值 则从数据库中进行查询获取数据
            $data=Goods::leftjoin("brand","goods.b_id","=","brand.b_id")
                    ->leftjoin("category","goods.cate_id","=","category.cate_id")
                    ->get();
            // 将从数据库中获取到的值存入缓存中  Cache::put('名字',值,'过期时间（秒  如果不设置过期时间则默认为永久有效）')
            // Cache::put('data',$data,60*60*24*30);//60秒*60=一小时*24=一天*30=一个月
            // 全局辅助函数 将数据存入缓存中 cache(['键名'=>值，过期时间])
            // cache(['data'=>$data,60*60*24*30]);
            $data=serialize($data);
            Redis::setex('data',60,$data);
        }
        // echo 123;die;
       $data=unserialize($data);

        return view('goods.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询品牌表的数据
        $brand_data=Brand::all();
        // dd($brand_data);
        // 查询分类表数据
        $c_data=Category::all();
        $cate_data=createTree($c_data);
        return view('goods.create',['brand_data'=>$brand_data,'cate_data'=>$cate_data]);
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
        // $rand=rand(100000,999999);
        $data['goods_code']=time();
        $data['add_time']=time();
        // 判断是否有文件被是上传  单文件上传
        if($request->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }

        // 多文件上传
        if($data['goods_imgs']){
           $photos=moreUploads('goods_imgs');
           $data['goods_imgs']=implode('|',$photos);
        }

        $res=Goods::insert($data);
        if($res){
            return redirect('goods');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
