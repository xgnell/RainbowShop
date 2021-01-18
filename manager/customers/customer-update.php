<?php
    define("MENU_OPTION", "customer");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected customer
    $customer_id = $_GET["id"];
    $customer = mysqli_fetch_array(sql_query("
        SELECT *
        FROM customers
        WHERE id=$customer_id;
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
    <title>Quản lý khách hàng</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Customer update form -->
            <form action="/manager/customers/customer-update-process.php" method="POST">
                <input type="number" name="id" value="<?= $customer["id"] ?>" hidden><br>
                Tên: <input type="text" name="name" value="<?= $customer["name"] ?>"><br>
                Giới tính: <select name="gender">
                    <option value="1" <?php if ($customer["gender"] == 1) echo "selected"; ?> >Nam</option>
                    <option value="0" <?php if ($customer["gender"] == 0) echo "selected"; ?> >Nữ</option>
                </select>
                Ngày tháng năm sinh: <input type="date" name="birth" value="<?= $customer["birth"] ?>"><br>
                Điện thoại: <input type="text" name="phone" value="<?= $customer["phone"] ?>"><br>
                Email: <input type="text" name="email" value="<?= $customer["email"] ?>"><br>
                Mật khẩu: <input type="password" name="passwd" value="<?= $customer["passwd"] ?>"><br>
                Địa chỉ: <input type="text" name="address" value="<?= $customer["address"] ?>"><br>
                
                <input type="submit" value="Xác nhận sửa">
                <input type="reset" value="Làm lại">
            </form>
        </div>
    </div>
</body>
</html>
