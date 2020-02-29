<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}
// 无限极分类
 function createTree($p_data,$p_id=0,$level=1){
            if(!$p_data){
                return;
            }

            static $cateInfo=[];
            foreach($p_data as $k=>$v){
                if($v->p_id==$p_id){
                    $v->level=$level;
                    $cateInfo[]=$v;
                    createTree($p_data,$v['cate_id'],$v['level']+1);

                }
            }
            return $cateInfo;
    }
// 单文件上传
 function upload($filename){
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
// 多文件上传
function moreUploads($filename){
    // 接收文件
    $photo=request()->file($filename);
    // 判断接收到的文件是不是数组
    if(!is_array($photo)){
        return;
    }
    foreach($photo as $v){
          // 判断上传过程是否有误
        if($v->isValid()){
        // 上传
        $store_result[]=$v->store('uploads');

      }
    }
    return $store_result;
}