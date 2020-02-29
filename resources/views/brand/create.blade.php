<center>
    <form action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        品牌名称：<input type='text' name='b_name'><br>
         品牌logo：<input type='file' name='b_logo'><br>
          品牌<input type='text' name='b_url'><br>
          <input type='submit' value="添加">
    </form>
</center>
