<?php
    define("MENU_OPTION", "customer");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Quản lý khách hàng</title>
    <script src="/manager/templates/js/generate-day.js"></script>
    <script src="/manager/templates/js/common-validate.js"></script>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Customer insertion form -->
            <form onsubmit="
                return validate_all({
                    name: [/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/, 'Tên không hợp lệ (Không chấp nhận số hoặc các kí tự đặc biệt)'],
                    phone: [/^0[0-9]{9,9}$/, 'Số điện thoại không hợp lệ (Chỉ chứa số, số mở đầu phải bằng 0 và đủ 10 số)'],
                    email: [/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Email không hợp lệ'],
                    passwd: true,
                },
                ['gender', 'birth']);
                "
                action="/manager/customers/customer-insert-process.php" method="POST">
                <table class="edit-table">
                    <!-- Tên -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Tên
                        </td>
                        <td>
                            <input id="input-name" type="text" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-name"></td>
                    </tr>

                    <!-- Giới tính -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Giới tính
                        </td>
                        <td>
                            <select id="select-gender" name="gender">
                                <option value="" disabled selected hidden>Chọn giới tính</option>
                                <option value="1">Nữ</option>
                                <option value="2">Nam</option>
                                <option value="3">Giới tính khác</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-gender"></td>
                    </tr>

                    <!-- Ngày tháng năm sinh -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Ngày tháng năm sinh
                        </td>
                        <td class="select-date">
                            <select name="birth_year" id="select-year" onchange="generate_day()">
                                <option value="" disabled selected hidden>Năm</option>
                                <?php
                                    for ($year = date("Y"); $year >= 1900; $year--) {
                                        ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <select name="birth_month" id="select-month" onchange="generate_day()">
                                <option value="" disabled selected hidden>Tháng</option>
                                <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                        <option value="<?= $month ?>"><?= $month ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <select name="birth_day" id="select-day">
                                <option value="" disabled selected hidden>Ngày</option>
                            </select>
                        </td>
                        <!-- <td>
                            <input type="date" placeholder="dd.mm.yyyy" name="birth">
                        </td> -->
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-birth"></td>
                    </tr>

                    <!-- Điện thoại -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Điện thoại
                        </td>
                        <td>
                            <input id="input-phone" type="text" name="phone">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-phone"></td>
                    </tr>

                    <!-- Email -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Email
                        </td>
                        <td>
                            <input id="input-email" type="text" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-email"></td>
                    </tr>

                    <!-- Mật khẩu -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Mật khẩu
                        </td>
                        <td>
                            <input id="input-passwd" type="password" name="passwd">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-passwd"></td>
                    </tr>

                    <!-- Địa chỉ -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Địa chỉ
                        </td>
                        <td>
                            <input id="input-address" type="text" name="address">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-address"></td>
                    </tr>

                    <!-- Action -->
                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Thêm khách hàng">
                                <input type="reset" value="Làm lại">
                            </div>
                        </td>
                    </tr>

                </table>

            </form>  
        </div>
    </div>
    <script>
        generate_day();
    </script>
</body>
</html>
