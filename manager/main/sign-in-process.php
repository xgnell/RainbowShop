<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

// Lấy các thông tin được gửi lên từ form
$admin_email_or_phone = $_POST["email_or_phone"];
$admin_passwd = $_POST["passwd"];
$admin_passwd = preg_replace('/(\'|\;|\ |\"|\#)/', '', $admin_passwd);


// Validate các thông tin gửi lên
$sign_in_success = false;
// Kiểm tra thông tin là email hay số điện thoại
if (is_numeric($admin_email_or_phone)) {
    // Dữ liệu là số điện thoại
    $admin_phone = $admin_email_or_phone;

    // Validate số điện thoại
    $phone_regex_pattern = "/^0[0-9]{9,9}$/";
    if (preg_match($phone_regex_pattern, $admin_phone)) {
        $is_sign_in_success = true;
        
        // Kiểm tra tài khoản có tồn tại trong cơ sở dữ liệu ko
        $result = sql_query("
            SELECT *
            FROM admins
            WHERE phone='$admin_phone' AND passwd='$admin_passwd';
        ");
        if (mysqli_num_rows($result) == 1) {
            // Tài khoản có tồn tại
            $is_sign_in_success = true;
        } else {
            // Tài khoản không tồn tại
            $is_sign_in_success = false;
            display_admin_sign_in_failure("Bạn nhập sai số điện thoại hoặc mật khẩu! Vui lòng thử lại", $admin_phone);
            exit();
        }

    } else {
        display_admin_sign_in_failure("Số điện thoại $admin_phone không hợp lệ! Vui lòng thử lại", $admin_phone);
        exit();
    }
} else {
    // Dữ liệu là email
    $admin_email = $admin_email_or_phone;

    // Validate email
    $email_regex_pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
    if (preg_match($email_regex_pattern, $admin_email)) {
        $sign_in_success = true;

        // Kiểm tra tài khoản có tồn tại trong cơ sở dữ liệu ko
        $result = sql_query("
            SELECT *
            FROM admins
            WHERE email='$admin_email' AND passwd='$admin_passwd';
        ");
        if (mysqli_num_rows($result) == 1) {
            // Tài khoản có tồn tại
            $is_sign_in_success = true;
        } else {
            // Tài khoản không tồn tại
            $is_sign_in_success = false;
            display_admin_sign_in_failure("Bạn nhập sai email hoặc mật khẩu! Vui lòng thử lại", $admin_email);
            exit();
        }

    } else {
        display_admin_sign_in_failure("Email $admin_email không hợp lệ! Vui lòng thử lại", $admin_email);
        exit();
    }
}

// Đăng nhập thành công
if ($sign_in_success) {
    $admin = mysqli_fetch_array($result);

    // Lấy thứ hạng (rank) của admin
    $admin_rank = sql_query("
        SELECT name, level
        FROM admin_ranks
        WHERE id = {$admin["id_rank"]};
    ");
    $admin_rank = mysqli_fetch_array($admin_rank);

    // Lưu thông tin đăng nhập vào session
    session_start();
    $_SESSION["user"] = [
        "type" => "admin",
        "admin" => [
            "id" => $admin["id"],
            "name" => $admin["name"],
            "rank" => [
                "name" => $admin_rank["name"],
                "level" => $admin_rank["level"]
            ]
        ]
    ];

    // Chuyển hướng đến trang quản lý admin
    header("location:/manager/main/main-manager.php");
} else {
    // Đăng nhập thất bại
    display_admin_sign_in_failure("Bạn nhập sai email, số điện thoại hoặc mật khẩu", $admin_email_or_phone);
}





function display_admin_sign_in_failure($message, $admin_email_or_phone) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">

        <title>Đăng nhập thất bại</title>
        <link rel="stylesheet" href="/manager/templates/css/all.css">
        <link rel="stylesheet" href="/manager/main/css/sign-in-process-style.css">
    </head>
    <body>
        <div id="admin-sign-in-process">
            <div class="container">
                <h2 style="color: red;"><?= $message ?></h2>
                <form action="/manager/main/sign-in.php" method="POST">
                    <input type="text" name="email_or_phone" value="<?= $admin_email_or_phone ?>" hidden>
                    <input id="btn-try-again" type="submit" value="Thử lại">
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}