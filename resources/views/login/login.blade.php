<form action="{{url('login/store')}}" method="post">
@csrf

    <table border=1>
        <tr>
            <td>用户</td>
            <td><input type='text' name='username'></td>

        </tr>
        <tr>
            <td>密码</td>
            <td><input type='password' name='pwd'></td>

        </tr>
        <tr>
            <td><input type='submit' value='登录'></td>
            <td></td>

        </tr>
    </table>
</form>