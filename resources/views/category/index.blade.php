<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 上下文类</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>湖北务工人员列表</h2><hr></center>

<table class="table">
    <thead>
        <tr>
            <th>分类ID</th>
            <th>分类名称</th>
            <th>操作</th>

        </tr>
    </thead>
    <tbody>
    @foreach($cate_data as $k=>$v)
   <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->cate_name}}</td>
            <td>
                <a href="{{url('/category/edit/'.$v->cate_id)}}">编辑</a>|
                <a href="javascript:void(0)" onclick="del({{$v->cate_id}})">删除</a>
            </td>

        </tr>
        @endforeach
    </tbody>
      <tbody>

   <tr>
            <td colspan="4">{{$cate_data->links()}}</td>


        </tr>

    </tbody>
</table>

</body>
<script>
    function del(id){
         if(!id){
            return;
         }
         if(window.confirm('确认要删除此分类吗?')){
             $.get(
                    '/category/destroy/'+id,
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