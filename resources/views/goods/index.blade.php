<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>商品的列表展示</title>
</head>
<body>
<center>
<table class="table" border=1>
    <thead>
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品相册</th>
            <th>商品价格</th>
            <th>商品库存</th>
            <th>商品编码</th>
            <th>商品介绍</th>
            <th>是否精品</th>
            <th>是否热卖</th>
            <th>添加时间</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width=100  height=50></td>
            <td>
                    @if($v->goods_imgs)
                    @php $photos=explode('|',$v->goods_imgs); @endphp
                    @foreach($photos as $vv)
                        <img src="{{env('UPLOAD_URL')}}{{$vv}}" width=100  height=50>
                    @endforeach
                    @endif

            </td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->goods_code}}</td>
            <td>{{$v->goods_desc}}</td>
            <td>{{$v->is_best==1?'√':'×'}}</td>
            <td>{{$v->is_hot==1?'√':'×'}}</td>
            <td>{{date("Y-m-d h:i:s"),$v->add_time}}</td>
        </tr>
@endforeach
    </tbody>
</table>
</center>
</body>
</html>