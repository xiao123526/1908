<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{csrf_token()}}">
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
<form class="form-horizontal" role="form" action="{{url('category/store')}}" method="post">
@csrf
<center><h2>商品分类添加表</h2><hr></center>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入分类名称" name='cate_name'>
                   <b style="color:red">{{$errors->first('username')}}</b>
        </div>
    </div>

    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">所属父分类</label>
        <div class="col-sm-10">
           <select class="form-control" id="firstname" name='p_id'>

               <option value="0">--请选择--</option>
                    @foreach($p_data as $k=>$v)
                    <option value="{{$v->cate_id}}">{!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}{{$v->cate_name}}</option>
                    @endforeach
           </select>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <input type='button' value="添加" class="btn btn-default" id="but">

        </div>
    </div>
</form>
</center>

</body>
<script>
    $("input[name='cate_name']").blur(function(){
        // 验证分类名称
        $(this).next().html('');
        var cate_name=$(this).val();
        var cate_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]+$/;
        if(!cate_reg.test(cate_name)){
            $(this).next().html('分类名称有数字字母下划线组成');
        }
         $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
        // 唯一性
        $.ajax({
            url:"/category/checkOnly",
            data:{cate_name,cate_name},
            type:'post',
            dataType:'json',
            success:function(result){
                if(result.count>0){
                    $("input[name='cate_name']").next().html('该分类名称已存在');
                    return;
                }
            }
        })
    })
    // 添加按钮
    $("#but").click(function(){
        var flag=true;
        var cate_name=$("input[name='cate_name']").val();
       var cate_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]+$/;
        if(!cate_reg.test(cate_name)){
            $("input[name='cate_name']").next().html('分类名称有数字字母下划线组成');
        }
         $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
          // 唯一性
        $.ajax({
            url:"/category/checkOnly",
            data:{cate_name,cate_name},
            type:'post',
            dataType:'json',
            async:false,
            success:function(result){
                if(result.count>0){
                    $("input[name='cate_name']").next().html('该分类名称已存在');
                    return flag=false;
                }
            }
        })
        if(!flag){
            return;
        }
        $('form').submit();

    })

</script>
</html>