<center>
<form action="{{url('student/update/'.$data->sid)}}" method="post">
@csrf
    学生姓名：<input typpe='text' name='sname' value="{{$data->sname}}"><br>
    学生性别：<input type='text' name='sex' value="{{$data->sex}}"><br>
    学生班级：<input type='text' name='sclass' value="{{$data->sclass}}"><br>
    学生成绩:<input type='text' name='score' value='{{$data->score}}'><br>
    <input type='submit' value="编辑">
</form>
</center>