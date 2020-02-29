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
<h1><center>管理员添加表</center></h1><hr/>

@if ($errors->any()) 
<div class="alert alert-danger"> 
<ul>
@foreach ($errors->all() as $error) 
<li>{{ $error }}</li> 
@endforeach
</ul> 
</div> 
@endif
<form action="{{url('admin/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入用户名">
			<b style="color:red">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="lastname" name="password"
				   placeholder="请输入密码">
				   <b style="color:red">{{$errors->first('password')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="lastname" name="passwords"
				   placeholder="请确认密码">
				   <b style="color:red">{{session('msg')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">电话</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="admin_tel"
				   placeholder="请输入电话">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="admin_email" 
                placeholder="请输入邮箱">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" class="btn btn-default" value="添加">
		</div>
	</div>
</form>

</body>
</html>