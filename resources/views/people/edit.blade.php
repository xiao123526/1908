<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<form class="form-horizontal" role="form" action="{{url('/people/update/'.$user->p_id)}}" method="post" enctype="multipart/form-data">
@csrf
<center><h2>编辑湖北务工人员信息</h2><hr></center>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">名字</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入名字" name='username' value="{{$user->username}}">
                   <b style="color:red">{{$errors->first('username')}}</b>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入年龄" name='age' value="{{$user->age}}">
                   <b style="color:red">{{$errors->first('age')}}</b>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入身份证号" name='card' value="{{$user->card}}">
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
        <img src="{{env('UPLOAD_URL')}}{{$user->head}}" width=100 height=50>
            <input type="file" class="form-control" id="firstname"
                   name='head'>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否是湖北人</label>
        <div class="col-sm-10">
           <input type="radio" name='is_hubei' value='1' @if($user->is_hubei=='1') checked @endif>是
             <input type="radio" name='is_hubei' value='2' @if($user->is_hubei=='2') checked @endif> 否
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">编辑</button>
        </div>
    </div>
</form>
</center>

</body>
</html>