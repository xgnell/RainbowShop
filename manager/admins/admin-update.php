<?php
    define("MENU_OPTION", "admin");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected admin
    $admin_id = $_GET["id"];
    $admin = mysqli_fetch_array(sql_query("
        SELECT *
        FROM admins
        WHERE id=$admin_id;
    "));
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
    <title>Quản lý admin</title>
    <script src="/manager/templates/js/common.js"></script>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Admin update form -->
            <form action="/manager/admins/admin-update-process.php" method="POST">
                <input type="number" name="id" value="<?= $admin["id"] ?>" hidden><br>
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
                                <option value="1" <?php if ($admin["gender"] == 1) echo "selected"; ?> >Nam</option>
                                <option value="0" <?php if ($admin["gender"] == 0) echo "selected"; ?> >Nữ</option>
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
                            $db_birth = strtotime($admin["birth"]);
                            $birth_day = date("d", $db_birth);
                            $birth_month = date("m", $db_birth);
                            $birth_year = date("Y", $db_birth);
                        ?>
                        <td class="select-date">
                            <select name="day" id="select-day">
                                <option value="" disabled selected hidden>Ngày</option>
                            </select>
                            <select name="month" id="select-month" onchange="generate_day()">
                                <option value="" disabled selected hidden>Tháng</option>
                                <?php
                                    for ($month = 1; $month <= 12; $month++) {
                                        ?>
                                        <option value="<?= $month ?>" <?php if ($birth_month == $month) echo 'selected'; ?> ><?= $month ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <select name="year" id="select-year" onchange="generate_day()">
                                <option value="" disabled selected hidden>Năm</option>
                                <?php
                                    for ($year = date("Y"); $year >= 1900; $year--) {
                                        ?>
                                        <option value="<?= $year ?>" <?php if ($birth_year == $year) echo 'selected'; ?> ><?= $year ?></option>
                                        <?php
                                    }
                                ?>
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
