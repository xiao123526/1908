<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    // 前台首页
    public function index(){
        return view('index.index');
    }
    /**
     * 展示商品列表
     * @return [type] [description]
     */
    public function prolist(){
        // 查询商品表的数据  并将数据传给视图页面
        $goods_data=Redis::get('goods_data');
        // dd($goods_data);
        if(!$goods_data){
            // echo "走数据路";
             $goods_data=Goods::get();
             $goods_data=serialize($goods_data);
             Redis::set('goods_data',$goods_data);

        }
        $goods_data=unserialize($goods_data);

        // Redis::flushall();

        return view('index/prolist',['goods_data'=>$goods_data]);
    }
    /**
     * 商品的详情页
     */
    public function proinfo($id){
        // 访问量+1
        $count=Redis::setnx('num_'.$id,1);
        if(!$count){
            $count=Redis::incr('num_'.$id);
        }

        // 根据商品id查询商品数据
        $data=Goods::where('goods_id','=',$id)->first();


        return view('index/proinfo',['data'=>$data,'count'=>$count]);
    }

}
