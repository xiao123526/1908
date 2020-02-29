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
<form>
    <input type='text' name='username' placeholder="请输入关键字进行搜索" value="{{$username}}">
    <input type='submit' value="搜索">
</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>年龄</th>
            <th>身份证号</th>
            <th>添加时间</th>
            <th>头像</th>
            <th>是否湖北人</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->p_id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->age}}</td>
            <td>{{$v->card}}</td>
            <td>{{date('Y-m-d h:i:s'),$v->add_time}}</td>
            <td>@if($v->head) <img src="{{env('UPLOAD_URL')}}{{$v->head}}" width=100 height=50> @endif</td>
            <td>{{$v->is_hubei=='1'?'√':'×'}}</td>
            <td><a href="{{url('/people/edit/'.$v->p_id)}}" class="btn btn-info" >编辑</a>
                <a href="{{url('/people/destroy/'.$v->p_id)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
            <tr>
                <td colspan="7">{{$data->appends(['username'=>$username])->links()}}</td>
            </tr>
    </tbody>
</table>

</body>
</html>