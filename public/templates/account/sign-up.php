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
            padding: 5%;
            margin: 50px 15% 50px 15%;
            display: flex;
            justify-content: center;
            background-image: url("/public/assets/backgrounds/bg-sign-up.jpg");
            background-size: cover;
        }

        .panel {
            right: 30px;
            width: 500px;
            /*height: 700px;*/
            background-color: rgba(255, 255, 255, 0.8);
            /* box-shadow: 1px 1px 5px #ccc; */
            padding: 20px 30px 20px 30px;
        }

        .form-title {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .input {
            margin-top: 5px;
            font-size: 1em;
            height: 30px;
            width: 100%;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            outline: none;
        }

        .title-input {
            height: 45px;
            line-height: 10px;
        }
        
        .title-input label {
            font-weight: bold;
            font-size: 1em;
            font-style: italic;
        }

        .button-submit {
            margin-top: 40px;
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>

    <div class="page-body">
        <div>
            <div class="panel">
                <div class="form-title">Đăng ký</div>
                <form action="/public/templates/account/sign-up-process.php" method="POST">
                    <table style="width: 100%">
                    <!-- Đây là Họ tên -->
                        <tr>
                            <td style="width: 120px" class="title-input">
                                <label>Họ và Tên</label><span class="error" id="error_name"><br>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" placeholder="Nhập tên của bạn" class="input">
                            </td>
                        </tr>
                    <!-- Giới tính -->
                        <tr>
                            <td class="title-input">
                                <label>Giới tính</label><span class="error" id="error_gender"><br>
                            </td>
                            <td>
                                <label id="men" style="margin-right: 30px;">
                                    <input type="radio" name="gender" id="men" value="1">Nam
                                </label>
                                <label id="women">
                                    <input type="radio" name="gender" id="women" value="0">Nữ
                                </label>
                            </td>
                        </tr>
                    <!-- Ngày sinh -->
                        <tr>
                            <td class="title-input">
                                <label>Ngày sinh</label><span class="error"></span>
                            </td>
                            <td>
                            <span>
                                <select name="birth_day">
                                    <?php 
                                    $start_date = 1;
                                    $end_date   = 31;
                                    for( $j=$start_date; $j<=$end_date; $j++ ) {
                                        echo '<option value='.$j.'>'.$j.'</option>';
                                    }
                                    ?>
                                </select>
                            </span>
                            <span>
                                <select name="birth_month">
                                    <?php for( $m=1; $m<=12; ++$m ) {
                                    ?>
                                    <option value="<?php echo $m; ?>" id="<?php echo $m; ?>"><?php echo "Tháng " . $m; ?></option>
                                    <?php } ?>
                                </select> 
                            </span>
                            <span>
                                <select name="birth_year">
                                    <?php 
                                    $year = date('Y');
                                    $min = $year - 100;
                                    $max = $year;
                                    for( $i=$max; $i>=$min; $i-- ) {
                                        echo '<option value='.$i.' id='.$i.'>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </span>
                            </td>
                        </tr>
                    <!-- Địa chỉ   -->
                        <tr>
                            <td class="title-input">
                                <label>Địa chỉ</label><span class="error" id="error_address"></span>
                            </td>
                            <td>
                                <?php include_once($root_path . "/select-city/index.php"); ?>
                            </td>
                        </tr>
                    <!-- Số điện thoại -->
                        <tr>
                            <td class="title-input">
                                <label>Số điện thoại</label><span class="error" id="error_phone_number"></span>
                            </td>
                            <td>
                                <input type="text" name="phone" id="phone_number" class="input" placeholder="Nhập số điện thoại">
                            </td>
                        </tr>
                    <!-- Email -->
                        <tr>
                            <td class="title-input">
                                <label>Email</label><span class="error" id="error_email"></span><br>
                            </td>
                            <td>
                                <input type="text" name="email" id="email" placeholder="Nhập email" class="input">
                            </td>
                        </tr>
                    <!-- Mật khẩu -->
                        <tr>
                            <td class="title-input">
                                <label>Mật khẩu</label><span class="error" id="error_passwd"></span>
                            </td>
                            <td>
                                <input type="password" name="passwd" placeholder="Nhập mật khẩu" id="passwd" class="input">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input class="btn-sign-up button-submit" type="submit" value="Đăng ký" onclick="return all_function()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    
    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>


<script>
    // function year(year) {
    //     return year;
    // }
    // function month(month) {
    //     return month;
    // }
    // function day(year, month) {
    //     switch (month) {
    //         case 1:
    //         case 3:
    //         case 5:
    //         case 7:
    //         case 8:
    //         case 10:
    //         case 12:
    //             day = 31;
    //             break;
    //         case 4:
    //         case 6:
    //         case 9:
    //         case 11:
    //             day = 30;
    //             break;
    //         case 2:
    //             if (year % 400 == 0) {
    //                 day = 29;
    //             } else if (year % 4 == 0) {
    //                 day = 29;
    //             } else {
    //                 day = 28;
    //             }
    //     }
    // }
    function check_name() {
        var name = document.getElementById("name").value;
        var name_pattern = /^[A-Za-z ]+$/;
        if (name_pattern.test(name)) {
            document.getElementById("name").style.borderColor = "#14e348";
            document.getElementById("error_name").innerHTML = "";
            return true;
        } else {
            document.getElementById("name").style.borderColor = "red";
            document.getElementById("error_name").innerHTML = " *";
            return false;
        }
    }
    function check_gender() {
        var radios = document.getElementsByName("gender");
        var formValid = false;

        var i = 0;
        while (!formValid && i < radios.length) {
            if (radios[i].checked) formValid = true;
            i++;        
        }

        if (!formValid) {
            document.getElementById("error_gender").innerHTML = " *";
            return false;
        } else {
            document.getElementById("error_gender").innerHTML = "";
            return true;
        }
    }
    function check_email() {
        var email = document.getElementById("email").value;
        var email_pattern = /^[A-za-z0-9]+@(gmail|yahoo|bkacad).(com|vn|gov)+$/;
        if (email_pattern.test(email)) {
            document.getElementById("email").style.borderColor = "#14e348";
            document.getElementById("error_email").innerHTML = "";
            return true;
        } else {
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("error_email").innerHTML = " *";
            return false;
        }
    }
    function check_passwd() {
        var passwd = document.getElementById("passwd").value;
        var passwd_pattern = /^[A-za-z0-9]+$/;
        if (passwd_pattern.test(passwd)) {
            document.getElementById("passwd").style.borderColor = "#14e348";
            document.getElementById("error_passwd").innerHTML = "";
            return true;
        } else {
            document.getElementById("passwd").style.borderColor = "red";
            document.getElementById("error_passwd").innerHTML = " *";
            return false;
        }
    }
    function check_address() {
        var city = document.getElementById("city");
        var district = document.getElementById("district");
        var city_selected = city.value;
        var district_selected = district.value;
        console.log(city_selected);

        if (city_selected == "" || district_selected == ""){
            document.getElementById("error_address").innerHTML = " *";
            return false;
        } else {
            document.getElementById("error_address").innerHTML = "";
            return true;
        }
    }
    function check_phone_number() {
        var phone_number = document.getElementById("phone_number").value;
        var phone_number_pattern = /^(03|05|07|08|09)+([0-9]{8})\b$/;
        if (phone_number_pattern.test(phone_number)) {
            document.getElementById("phone_number").style.borderColor = "#14e348";
            document.getElementById("error_phone_number").innerHTML = "";
            return true;
        } else {
            document.getElementById("phone_number").style.borderColor = "red";
            document.getElementById("error_phone_number").innerHTML = " *";
            return false;
        }
    }

    function all_function() {
        check_name();
        check_gender();
        check_email();
        check_phone_number();
        check_passwd();
        check_address();
        // check_address();
        if (check_name() && check_email() && check_phone_number() && check_passwd() && check_gender() && check_address()) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>