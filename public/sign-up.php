<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "signup");
require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Sign up</title>
    <style>
        .error {
            color: red;
        }
        .error_notice {
            font-size: 15px;
            color: red;
        }
        .page-body {
            display: flex;
            justify-content: flex-end;
        }

        .panel {
            right: 30px;
            margin: 30px 200px 30px 30px;
            width: 450px;
            /*height: 700px;*/
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            padding: 20px 30px 20px 30px;
        }

        .form-title {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            font-size: 1em;
            font-style: italic;
        }

        input {
            margin-top: 5px;
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>

    <div class="page-body">
        <div class="panel">
            <div class="form-title">Đăng ký</div>
            <form action="/public/account/sign-up-process.php" method="POST">
                <label>Tên</label><span class="error" id="error_name"></span>
                <input type="text" name="name" id="name"><br>
                <span class="error_notice" id="error_name_notice"></span><br>

                <label>Email</label><span class="error" id="error_email"></span><br>
                <input type="text" name="email" id="email"><br>
                <span class="error_notice" id="error_email_notice"></span><br>

                <label>Giới tính</label><span class="error"></span><br>
                <select name="gender">
                    <option value="0">Nữ</option>
                    <option value="1">Nam</option>
                </select>
                
                <br><br>

                <label>Mật khẩu</label><span class="error" id="error_passwd"></span><br>
                <input type="password" name="passwd" placeholder="Nhập mật khẩu" id="passwd"><br>
                <span class="error_notice" id="error_passwd_notice"></span><br>

                <label>Địa chỉ</label><span class="error" id="error_address"></span><br>
                <input type="text" name="address" id="address"><br>
                <span class="error_notice" id="error_address_notice"></span><br>

                <label>Ngày sinh</label><span class="error"></span><br>
                <input type="date" name="birth"><br><br>

                <label>Số điện thoại</label><span class="error" id="error_phone_number"></span><br>
                <input type="text" name="phone" id="phone_number"><br>
                <span class="error_notice" id="error_phone_number_notice"></span><br>

                <input class="btn-sign-up" type="submit" value="Đăng ký" onclick="return all_function()"><br>

            </form>
        </div>
    </div>
    
    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>


<script>
    function check_phone_number() {
        var phone_number = document.getElementById("phone_number").value;
        var phone_number_pattern = /^(03|05|07|08|09)+([0-9]{8})\b$/;
        if (phone_number_pattern.test(phone_number)) {
            document.getElementById("phone_number").style.borderColor = "#14e348";
            document.getElementById("error_phone_number").innerHTML = "";
            document.getElementById("error_phone_number_notice").innerHTML = "";
            return true;
        } else {
            document.getElementById("phone_number").style.borderColor = "red";
            document.getElementById("error_phone_number").innerHTML = "*";
            document.getElementById("error_phone_number_notice").innerHTML = "Thông tin về số điện thoại bị sai";
            return false;
        }
    }

    function check_name() {
        var name = document.getElementById("name").value;
        var name_pattern = /^[A-Za-z ]+$/;
        if (name_pattern.test(name)) {
            document.getElementById("name").style.borderColor = "#14e348";
            document.getElementById("error_name").innerHTML = "";
            document.getElementById("error_name_notice").innerHTML = "";
            return true;
        } else {
            document.getElementById("name").style.borderColor = "red";
            document.getElementById("error_name").innerHTML = "*";
            document.getElementById("error_name_notice").innerHTML = "Thông tin về tên bị sai";
            return false;
        }
    }
    
    function check_email() {
        var email = document.getElementById("email").value;
        var email_pattern = /^[A-za-z0-9]+@(gmail|yahoo|bkacad).(com|vn|gov)+$/;
        if (email_pattern.test(email)) {
            document.getElementById("email").style.borderColor = "#14e348";
            document.getElementById("error_email").innerHTML = "";
            document.getElementById("error_email_notice").innerHTML = "";
            return true;
        } else {
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("error_email").innerHTML = "*";
            document.getElementById("error_email_notice").innerHTML = "Thông tin về email bị sai";
            return false;
        }
    }
    function check_passwd() {
        var passwd = document.getElementById("passwd").value;
        var passwd_pattern = /^[A-za-z0-9]+$/;
        if (passwd_pattern.test(passwd)) {
            document.getElementById("passwd").style.borderColor = "#14e348";
            document.getElementById("error_passwd").innerHTML = "";
            document.getElementById("error_passwd_notice").innerHTML = "";
            return true;
        } else {
            document.getElementById("passwd").style.borderColor = "red";
            document.getElementById("error_passwd").innerHTML = "*";
            document.getElementById("error_passwd_notice").innerHTML = "Thiếu mật khẩu";
            return false;
        }
    }
    function check_address() {
        var address = document.getElementById("address").value;
        var address_pattern = /^[A-Za-z ]+$/;
        if (address_pattern.test(address)) {
            document.getElementById("address").style.borderColor = "#14e348";
            document.getElementById("error_address").innerHTML = "";
            document.getElementById("error_address_notice").innerHTML = "";
            return true;
        } else {
            document.getElementById("address").style.borderColor = "red";
            document.getElementById("error_address").innerHTML = "*";
            document.getElementById("error_address_notice").innerHTML = "Thông tin địa chỉ bị sai";
            return false;
        }
    }

    function all_function() {
        return check_name() &
                check_email() &
                check_phone_number() &
                check_passwd() &
                check_address();
    }
</script>
</html>