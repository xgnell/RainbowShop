<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "signup");
require_once($root_path . "/config/db.php");
require_once($root_path . "/public/templates/account/check-customer-signed-in.php");

if (isset($_SESSION['user']['customer'])) {
    header('location:/public/home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Sign up</title>
    <style>
        .page-body {
            padding: 5%;
            min-width: 700px;
            /* margin: 50px 15% 50px 15%; */
            display: flex;
            justify-content: center;
        }

        .panel {
            right: 30px;
            width: 700px;
            /*height: 700px;*/
            background-color: rgba(255, 255, 255, 0.8);
            /* box-shadow: 1px 1px 5px #ccc; */
            padding: 20px 30px 20px 30px;
        }

        .panel .form-title {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .panel .form-sign-up {
            width: 100%;
        }

        .panel .form-sign-up .display-error {
            color: red;
        }

        .panel .form-sign-up .title {
            font-size: 15px;
            width: 200px;
            height: 40px;
            padding-bottom: 5px;
        }

        .panel .form-sign-up .input {
            font-size: 15px;
            width: 400px;
            min-width: 300px;
            height: 40px;
            padding: 5px 10px 5px 10px;
            border: 1px #ccc solid;
        }
        .panel .form-sign-up .select {
            font-size: 15px;
            width: 124px;
            height: 40px;
            border: 1px #ccc solid;
            margin-right: 10px;
        }

        .panel .form-sign-up .bottom {
            width: 300px;
            min-width: 200px;
            height: 40px;
        }

        table tr td {
            margin-bottom: 20px;
        }
    </style>
    <script src="/public/templates/js/common-validate.js"></script>
    <script src="/public/templates/js/generate-day.js"></script>

</head>

<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>

    <div class="page-body">
        <div>
            <div class="panel">
                <h1 class="form-title">Đăng ký</h1>
                <form onsubmit="
                    return validate_all({
                        name: [/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/, 'Tên không hợp lệ (Không chấp nhận số hoặc các kí tự đặc biệt)'],
                        phone: [/^0[0-9]{9,9}$/, 'Số điện thoại không hợp lệ (Chỉ chứa số, số mở đầu phải bằng 0 và đủ 10 số)'],
                        email: [/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Email không hợp lệ'],
                        passwd: true,
                    },
                    ['gender', 'birth']);
                    "
                    action="/public/templates/account/sign-up-process.php"
                    method="POST">
                    <table class="form-sign-up">
                    <!-- Đây là Họ tên -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Họ và Tên</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="input-name" placeholder="Nhập tên của bạn" class="input">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-name"></td>
                        </tr>
                    <!-- Giới tính -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Giới tính</label>
                            </td>
                            <td>
                                <select id="select-gender" name="gender" class="input">
                                    <option value="" disabled selected hidden>Chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Giới tính khác</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-gender"></td>
                        </tr>
                    <!-- Ngày sinh -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Ngày sinh</label>
                            </td>
                            <td>
                                <select name="birth_year" id="select-year" onchange="generate_day()" class="select">
                                    <option value="" disabled selected hidden>Năm</option>
                                    <?php
                                        for ($year = date("Y"); $year >= 1900; $year--) {
                                            ?>
                                            <option value="<?= $year ?>"><?= $year ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <select name="birth_month" id="select-month" onchange="generate_day()" class="select">
                                    <option value="" disabled selected hidden>Tháng</option>
                                    <?php
                                        for ($month = 1; $month <= 12; $month++) {
                                            ?>
                                            <option value="<?= $month ?>"><?= $month ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <select name="birth_day" id="select-day" class="select">
                                    <option value="" disabled selected hidden>Ngày</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-birth"></td>
                        </tr>
                    <!-- Địa chỉ   -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Địa chỉ</label>
                            </td>
                            <td>
                                <input type="text" name="address" id="input-address" class="input" placeholder="Nhập địa chỉ">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-address"></td>
                        </tr>
                    <!-- Số điện thoại -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Số điện thoại</label>
                            </td>
                            <td>
                                <input type="text" name="phone" id="input-phone" class="input" placeholder="Nhập số điện thoại">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-phone"></td>
                        </tr>
                    <!-- Email -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" id="input-email" placeholder="Nhập email" class="input">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-email"></td>
                        </tr>
                    <!-- Mật khẩu -->
                        <tr>
                            <td rowspan="2" class="title">
                                <label>Mật khẩu</label>
                            </td>
                            <td>
                                <input type="password" name="passwd" placeholder="Nhập mật khẩu" id="input-passwd" class="input">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-passwd"></td>
                        </tr>
                    <!-- Thực thi -->
                        <tr>
                            <td colspan="2" style="height: 50px;">
                                <div class="action-area">
                                    <input type="submit" value="Đăng ký" class="bottom">
                                    <input type="reset" value="Điền lại" class="bottom">
                                </div>
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
    generate_day();
</script>
</html>