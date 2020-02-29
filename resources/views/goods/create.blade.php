<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品添加</title>
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
<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
@csrf
<center><h2>商品添加页面</h2><hr></center>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入商品名称" name='goods_name'>

        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入商品价格" name='goods_price'>

        </div>
         <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label" >商品所属品牌</label>
        <div class="col-sm-10">
            <select name='b_id' class="form-control">
                <option value=''>--请选择--</option>
                @foreach($brand_data as $k=>$v)
                    <option value='{{$v->b_id}}'>{{$v->b_name}}</option>
                @endforeach
            </select>

        </div>
           <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label" >商品所属分类</label>
        <div class="col-sm-10">
            <select name='cate_id' class="form-control">
                <option value=''>--请选择--</option>
                @foreach($cate_data as $k=>$v)
                    <option value='{{$v->cate_id}}'>{!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}{{$v->cate_name}}</option>
                @endforeach
            </select>

        </div>

    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="firstname"
                   name='goods_img'>
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="firstname"
                   name='goods_imgs[]' multiple="multiple">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
        <input type='text' name='goods_num' placeholder="请输入商品库存" class="form-control" id="firstname">
        </div>
    </div>
  <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品介绍</label>
        <div class="col-sm-10">
       <textarea name='goods_desc' class="form-control" id="firstname" placeholder="请输入商品描述"></textarea>
        </div>
    </div>
     <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-10">
            <input type='radio' name='is_best' value="1" checked>是
            <input type='radio' name='is_best' value='2'>否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否热卖</label>
        <div class="col-sm-10">
            <input type='radio' name='is_hot' value="1" checked>是
            <input type='radio' name='is_hot' value='2'>否
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type='submit' value="添加" class="btn btn-default">
            <!-- <button type="submit" class="btn btn-default">添加</button> -->
        </div>
    </div>
</form>
</center>

</body>
</html>