<center>
<form action="{{url('student/store')}}" method="post">
@csrf
    学生姓名：<input typpe='text' name='sname'><br>
    学生性别：<input type='text' name='sex'><br>
    学生班级：<input type='text' name='sclass'><br>
    学生成绩:<input type='text' name='score'><br>
    <input type='submit' value="添加">
</form>
</center>