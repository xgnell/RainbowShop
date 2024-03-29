<?php
    define("MENU_OPTION", "admin");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
    require_once($root_path . "/manager/admins/admin-notification.php");
    require_once($root_path . "/manager/templates/notification-page.php");

    $notification_title = "Thay đổi thông tin tài khoản admin";

    check_admin_signed_in(2);

    $admin_id = $_SESSION["user"]["admin"]["id"];
    if (!empty($_POST)) {
        $admin = [
            'id' => $admin_id,
            'name' => $_POST["name"] ?? "",
            'gender' => $_POST["gender"] ?? "",
            
            'birth_year' => $_POST["birth_year"] ?? "",
            'birth_month' => $_POST["birth_month"] ?? "",
            'birth_day' => $_POST["birth_day"] ?? "",

            'phone' => $_POST["phone"] ?? "",
            'email' => $_POST["email"] ?? "",
            'passwd' => ""
        ];
    } else {
        $admin = mysqli_fetch_array(sql_query("
            SELECT *
            FROM admins
            WHERE id = $admin_id;
        "));
    }
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
    <title>Thay đổi thông tin tài khoản admin</title>
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
            <!-- Admin change info form -->
            <form onsubmit="
                return validate_all({
                    name: [/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/, 'Tên không hợp lệ (Không chấp nhận số hoặc các kí tự đặc biệt)'],
                    phone: [/^0[0-9]{9,9}$/, 'Số điện thoại không hợp lệ (Chỉ chứa số, số mở đầu phải bằng 0 và đủ 10 số)'],
                    email: [/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Email không hợp lệ'],
                    passwd: true,
                },
                ['gender', 'birth']);
                "
                action="/manager/admins/admin-change-process.php" method="POST">
                <table class="edit-table">
                    <!-- Tên -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Tên
                        </td>
                        <td>
                            <input id="input-name" type="text" name="name" value="<?= $admin["name"] ?>">
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
                                <option value="1" <?php if ($admin["gender"] == 1) echo "selected"; ?> >Nữ</option>
                                <option value="2" <?php if ($admin["gender"] == 2) echo "selected"; ?> >Nam</option>
                                <option value="3" <?php if ($admin["gender"] == 3) echo "selected"; ?> >Giới tính khác</option>
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
                        <?php
                            $birth_day = null;
                            $birth_month = null;
                            $birth_year = null;
                            if (array_key_exists("birth", $admin)) {
                                $db_birth = strtotime($admin["birth"]);
                                $birth_day = date("d", $db_birth);
                                $birth_month = date("m", $db_birth);
                                $birth_year = date("Y", $db_birth);
                            } else {
                                $birth_day = $admin["birth_day"];
                                $birth_month = $admin["birth_month"];
                                $birth_year = $admin["birth_year"];
                            }
                        ?>
                        <td class="select-date">
                            <select name="birth_year" id="select-year" onchange="generate_day()">
                                <option value="" disabled selected hidden>Năm</option>
                                <?php
                                    for ($year = date("Y"); $year >= 1900; $year--) {
                                        ?>
                                        <option value="<?= $year ?>" <?php if ($birth_year == $year) echo 'selected'; ?> ><?= $year ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <select name="birth_month" id="select-month" onchange="generate_day()">
                                <option value="" disabled selected hidden>Tháng</option>
                                <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                        <option value="<?= $month ?>" <?php if ($birth_month == $month) echo 'selected'; ?> ><?= $month ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <select name="birth_day" id="select-day">
                                <option value="" disabled selected hidden>Ngày</option>
                            </select>
                        </td>
                        
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
                            <input id="input-phone" type="text" name="phone" value="<?= $admin["phone"] ?>">
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
                            <input id="input-email" type="text" name="email" value="<?= $admin["email"] ?>">
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
                            <input id="input-passwd" type="password" name="passwd" value="<?= $admin["passwd"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-passwd"></td>
                    </tr>

                    <!-- Action -->
                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Xác nhận sửa">
                                <input type="reset" value="Làm lại">
                            </div>
                        </td>
                    </tr>

                </table>

            </form>
        </div>
    </div>
    <script>
        generate_day(<?= $birth_day ?>);
    </script>
</body>
</html>
