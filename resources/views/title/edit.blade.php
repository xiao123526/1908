<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
    <center>
    <form action="{{url('title/update/'.$data->tid)}}" method='post' enctype='multipart/form-data'>
    @csrf
        <table border=1>
            <tr>
                <td>文章标题</td>
                <td>
                    <input type='text' name='tname' value="{{$data->tname}3}">
                </td>
            </tr>
            <tr>
                <td>文章分类</td>
                <td>
                    <input type='text' name='type' value="{{$data->type}}">
                </td>
            </tr>
            <tr>
                <td>文章的重要性</td>
                <td>
                    <input type='radio' name='important' value='1' {{$data->important==1?'checked':''}}>普通
                    <input type='radio' name='important' value='2' {{$data->important==2?'checked':''}}>顶置
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                     <input type='radio' name='is_show' value='1' {{$data->is_show==1?'checked':''}}>显示
                    <input type='radio' name='is_show' value='2' {{$data->is_show==2?'checked':''}}>不显示
                </td>
            </tr>
            <tr>
                <td>文章作者</td>
                <td>
                    <input type='text' name='autor' value="{{$data->autor}}">
                </td>
            </tr>
            <tr>
                <td>作者Email</td>
                <td>
                    <input type='text' name='email' value="{{$data->email}}">
                </td>
            </tr>
            <tr>
                <td>关键字</td>
                <td>
                    <input type='text' name='vital' value="{{$data->vital}}">
                </td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td>
                    <textarea name='desc' value="{{$data->desc}}"></textarea>
                </td>
            </tr>
            <tr>
                <td>上传文件</td>
                <td>
                  <img src="{{env('UPLOAD_URL')}}{{$data->timg}}" width=100 height=50>
                    <input type='file' name='timg'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='button' value='修改'>
                </td>
                <td>

                </td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>

<script>
        $("input[name='tname']").blur(function(){
            $(this).next().html('');
            var title=$(this).val();
            var title_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]+$/;
           if(!title_reg.test(title)){
                $(this).next().html('文章标题由中文、数字、字母下划线组成且不能为空');
                return;
           }
           $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
           // 唯一性验证
           $.ajax({
                url:"/title/checkOnly",
                type:'post',
                data:{title:title},
                dataType:'json',
                success:function(result){
                    // console.log(result);
                    // return;
                    if(result.count>0){
                        // console.log(123);
                        $("input[name='tname']").next().html('该标题已存在');
                    }
                }
            })
        })
        // 作者验证
        $("input[name='autor']").blur(function(){
            $("input[name='autor']").next().html('');
            var autor=$(this).val();
            var autor_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]{2,8}$/;
            if(!autor_reg.test(autor)){
                $("input[name='autor']").next().html('文章作者可以有数字字母下划线2-8位组成且不能为空');
            }
        })
        // 添加按钮
        $("input[type='button']").click(function(){
            // 标题验证
            var titleflag=true;
            var title=$("input[name='tname']").val();
            var title_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]+$/;
              if(!title_reg.test(title)){
                $("input[name='tname']").next().html('文章标题由中文、数字、字母下划线组成且不能为空');
                return;
            }
           // 唯一性验证
           $.ajax({
                url:"/title/checkOnly",
                type:'post',
                data:{title:title},
                dataType:'json',
                async:false,
                success:function(result){
                    // console.log(result);
                    // return;
                    if(result.count>0){
                        // console.log(123);
                        $("input[name='tname']").next().html('该标题已存在');
                        titleflag=false;
                    }
                }
            });
           if(!titleflag){
             return;
           }


            // 作者验证
            var writer=$("input[name='autor']").val();
            var writer_reg=/^[\u4e00-\u9fa50-9a-zA-Z_-]{2,8}$/;
            if(!writer_reg.test(writer)){
                $("input[name='autor']").next().html('文章作者可以有数字字母下划线2-8位组成且不能为空');
            }
            // 表单提交
            $('form').submit();
        })

</script>