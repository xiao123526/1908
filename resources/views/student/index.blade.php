<center>
    <table border=1>
        <tr>
            <td>学生id</td>
            <td>学生姓名</td>
            <td>学生性别</td>
            <td>学生班级</td>
            <td>学生成绩</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->sid}}</td>
            <td>{{$v->sname}}</td>
            <td>{{$v->sex}}</td>
            <td>{{$v->sclass}}</td>
            <td>{{$v->score}}</td>
            <td>
                <a href="{{url('student/deit/'.$v->sid)}}">编辑</a>
                <a href="{{url('student/destroy/'.$v->sid)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</center>