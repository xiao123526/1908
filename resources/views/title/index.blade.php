<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
   <style>
       ul li{
           list-style:none;
           color:red;
           float:left;
           margin-left:10px;
       }
   </style>
<script src="/static/js/jquery.min.js"></script>

</head>
<body>
    <center>
<form>
    <input type='text' name='type' placeholder="请输入分类关键字" value="{{$type}}">
    <input type='text' name='tname' placeholder="请输入标题关键字" value="{{$tname}}">
    <input type='submit' value='搜索'>
</form>
    <table border=1>
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>图片</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->tid}}</td>
            <td>{{$v->tname}}</td>
            <td>{{$v->type}}</td>
            <td>{{$v->important==1?'普通':'顶置'}}</td>
            <td>{{$v->is_show==1?'√':'×'}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->timg}}" width=100 height=50></td>
            <td>{{date('Y-m-d h:i:s'),$v->add_time}}</td>
            <td>
                <a href="{{url('/title/edit/'.$v->tid)}}">编辑</a>
                <a href="javascript:void(0)" onclick="del({{$v->tid}})">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->appends(['type'=>$type,'tname'=>$tname])->links()}}
</center>
</body>
<script>
function del(id){
    if(!id){
        return;
    }
    if(window.confirm('是否要删除此条记录')){
        $.get(
                '/title/destroy/'+id,
                function(result){
                    if(result.code=='00000'){
                        location.reload();
                    }
                },
                'json'
            )
    }
}
</script>
</html>