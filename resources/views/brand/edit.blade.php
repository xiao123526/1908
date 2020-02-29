<center>
    <form action="{{url('brand/update/'.$data->b_id)}}" method="post" enctype="multipart/form-data">
    @csrf
        品牌名称：<input type='text' name='b_name' value=
        '{{$data->b_name}}'><br>
        <img src="{{env('UPLOAD_URL')}}{{$data->b_logo}}" width=100 height=50>
         品牌logo：<input type='file' name='b_logo'><br>
          品牌<input type='text' name='b_url' value="{{$data->b_url}}"><br>
          <input type='submit' value="编辑">
    </form>
</center>
