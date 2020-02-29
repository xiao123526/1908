<form action="{{route('brand')}}" method="post" >
@csrf
<h2>添加页面</h2>
   <input type='text' name='username'>
   <input type='text' name='age'>
   <input type='submit' value='添加'>
</form>