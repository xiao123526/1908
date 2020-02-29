<center>
    <table border=1>
        <tr>
            <td>品牌ID</td>
            <td>品牌名称</td>
            <td>品牌logo</td>
            <td>品牌网址</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->b_id}}</td>
            <td>{{$v->b_name}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->b_logo}}" width=100 height=50</td>
            <td>{{$v->b_url}}</td>
            <td>
                <a href="{{url('/brand/edit/'.$v->b_id)}}">编辑</a>
                <a href="{{url('/brand/destroy/'.$v->b_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</center>