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
   <!--  @if($errors->any())
     <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

     </div>
    @endif -->
<form class="form-horizontal" role="form" action="{{route('store')}}" method="post" enctype="multipart/form-data">
@csrf
<center><h2>湖北务工人员信息统计</h2><hr></center>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">名字</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入名字" name='username'>
                   <b style="color:red">{{$errors->first('username')}}</b>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入年龄" name='age'>
                   <b style="color:red">{{$errors->first('age')}}</b>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入身份证号" name='card'>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="firstname"
                   name='head'>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否是湖北人</label>
        <div class="col-sm-10">
           <input type="radio" name='is_hubei' value='1'>是
             <input type="radio" name='is_hubei' value='2' checked> 否
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>
</center>

</body>
</html>