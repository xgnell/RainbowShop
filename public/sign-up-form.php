<div class="page-body">
    <div class="panel">
        <div class="form-title">Đăng ký</div>
        <form action="/public/sign-up-process.php" method="POST">
            <label>Tên</label><span class="error" id="error_name"></span><br>
            <input type="text" name="name" id="name"><br>
            <span class="error_notice" id="error_name_notice"></span><br><br>

            <label>Email</label><span class="error" id="error_email"></span><br>
            <input type="text" name="email" id="email"><br>
            <span class="error_notice" id="error_email_notice"></span><br><br>

            <label>Giới tính</label><span class="error"></span><br>
            <select name="gender">
                <option value="0">Nữ</option>
                <option value="1">Nam</option>
            </select><br><br>

            <label>Mật khẩu</label><span class="error" id="error_passwd"></span><br>
            <input type="password" name="passwd" placeholder="Nhập mật khẩu" id="passwd"><br><br>
            <span class="error_notice" id="error_passwd_notice"></span><br><br>

            <label>Địa chỉ</label><span class="error"></span><br>
            <input type="text" name="address"><br><br>

            <label>Ngày sinh</label><span class="error"></span><br>
            <input type="date" name="birth"><br><br>

            <label>Số điện thoại</label><span class="error" id="error_phone_number"></span><br>
            <input type="text" name="phone" id="phone_number"><br>
            <span class="error_notice" id="error_phone_number_notice"></span><br><br>

            <input class="btn-sign-up" type="submit" value="Đăng ký" onclick="return all_function()"><br><br>

        </form>
    </div>
</div>