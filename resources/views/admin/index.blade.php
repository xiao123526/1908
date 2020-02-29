<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<h1><center>管理员展示表</center></h1><hr/>
<table class="table">
	<thead>
		<tr>
			<th>管理员id</th>
			<th>管理员名称</th>
			<th>管理员电话</th>
            <th>管理员邮箱</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach($data  as  $k=>$v)
		<tr @if($k%2==0) class="success" @else class="warning" @endif>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>
            <td>{{$v->admin_email}}</td>
            <td><a href="javascript:;" onclick="del({{$v->admin_id}})" class="btn btn-warning">删除</a>
                <a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
            </td>
		</tr>
    @endforeach
	<tr><td colspan="7">{{$data->links()}}</td></tr>
	</tbody>
</table>


</body>
<script>
    function del(admin_id){
        if(!admin_id){
            return;
        }
        if(confirm('是否确认删除???')){
            $.get(
                "/admin/destroy/"+admin_id,
                function(res){
                    if(res.code=='00000'){
                        location.reload();
                    }
                },
                'json'
            );
        }
    }
</script>
</html>