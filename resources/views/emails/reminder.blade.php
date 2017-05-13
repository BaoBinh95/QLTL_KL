<div class="mail_confirm" >
    <center>
        <table>
            <tr>
                <td align="center" valign="top">
                    <table >
                        <tbody>
                            <tr>
                                <td>
                                    <h1>Xin chào {{ $data['name'] }}</h1>
                                    <p>Đây là tài khoản đăng nhập vào trang web <a href="http://pacific-beach-45495.herokuapp.com/">quản lý tài liệu</a>:
                                    <p>Email: {{ $data['email'] }}</p>
                                    <p>Username: {{ $data['name'] }}</p>
                                    <p>Init Password: {{ $data['password'] }}</p>
                                    <br/>
                                    <strong>Chú ý: Bạn nên thay đổi password ngay từ lần đăng nhập đầu tiên.</strong><br>
                                    <br/>
                                    <em>Thân,</em><br/>
                                    <br/>
                                    Document Management Administrator<br/>

                                    Mail: phamha.test@gmail.com
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</div>


