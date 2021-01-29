<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

// Lấy các thông tin được gửi lên từ form
require_once($root_path . "/notification/display-error-page.php");

if (empty($_POST)) {
    display_error_page(404, "Không tìm thấy trang");
    exit();
}
// Get sign in data
$customer_email = $_POST["email"] ?? null;
$customer_passwd = $_POST["passwd"] ?? null;

$customer_passwd = preg_replace('/(\'|\;|\ |\"|\#)/', '', $customer_passwd);

// Mã hoá dữ liệu
$customer_email = htmlspecialchars($customer_email);
$customer_passwd = htmlspecialchars($customer_passwd);


// Validate các thông tin gửi lên
$sign_in_success = false;
// Validate email
$email_regex_pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
if (preg_match($email_regex_pattern, $customer_email)) {
    $sign_in_success = true;

    // Kiểm tra tài khoản có tồn tại trong cơ sở dữ liệu ko
    $result = sql_query("
        SELECT *
        FROM customers
        WHERE email='$customer_email' AND passwd='$customer_passwd';
    ");
    if (mysqli_num_rows($result) == 1) {
        // Tài khoản có tồn tại
        $result = mysqli_fetch_array($result);

        // Kiểm tra tài khoản có bị khóa không
        if ($result["id_state"] == 2) {
            $is_sign_in_success = false;
            display_customer_lock();
            exit();
        } else {
            $is_sign_in_success = true;
        }
    } else {
        // Tài khoản không tồn tại
        $is_sign_in_success = false;
        display_customer_sign_in_failure("Bạn nhập sai email hoặc mật khẩu! Vui lòng thử lại");
        exit();
    }

} else {
    display_customer_sign_in_failure("Email $customer_email không hợp lệ! Vui lòng thử lại");
    exit();
}

// Đăng nhập thành công
if ($sign_in_success) {
    $customer = $result;

    // Lưu thông tin đăng nhập vào session
    session_start();
    $_SESSION["user"] = [
        "type" => "customer",
        "customer" => [
            "id" => $customer["id"],
            "name" => $customer["name"],
            "cart" => []
        ]
    ];

    // Chuyển hướng đến trang quản lý admin
    header("location:/public/home.php");
} else {
    // Đăng nhập thất bại
    display_customer_sign_in_failure("Bạn nhập sai email hoặc mật khẩu");
}





function display_customer_sign_in_failure($message) {
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
        <link rel="stylesheet" href="/public/templates/css/all.css">
        <link rel="stylesheet" href="/public/templates/css/sign-in-process-style.css">
    </head>
    <body>
        <div id="customer-sign-in-process">
            <div class="container">
                <h2 style="color: red;"><?= $message ?></h2>
                <!-- <form action="/public/home.php" method="POST"> -->
                    <button id="btn-try-again" onclick="window.history.back();">Thử lại</button>
                <!-- </form> -->
            </div>
        </div>
    </body>
    </html>
    <?php
}

function display_customer_lock() {
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
        <link rel="stylesheet" href="/public/templates/css/all.css">
        <link rel="stylesheet" href="/public/templates/css/sign-in-process-style.css">
    </head>
    <body>
        <div id="customer-sign-in-process">
            <div class="container">
                <h2 style="color: red;">Tài khoản của bạn đã bị khóa</h2>
                <p>Vui lòng liên hệ lại để biết thêm chi tiết</p>
            </div>
        </div>
    </body>
    </html>
    <?php
}