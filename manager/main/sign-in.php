<?php
    session_start();
    if (isset($_SESSION["user"]["admin"])) {
        header("location:/manager/main/main-manager.php");
    }

    // Lấy dữ liệu từ lần nhập form trước (nếu có)
    $email_or_phone = $_POST["email_or_phone"] ?? null;
    $passwd = $_POST["passwd"] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/main/css/sign-in-style.css">
    <script defer src="/manager/main/js/sign-in-action.js"></script>
</head>
<body>
    <div id="admin-sign-in-form">
        <div class="container">
            <div class="admin-form-header">
                <h1>Đăng nhập</h1>
            </div>
            <div class="admin-form-content">
                <form onsubmit="admin_sign_in_form_validate(event)" action="/manager/main/sign-in-process.php" method="POST">
                    
                    <div class="input-container">
                        <div class="display-error" id="display-error-email-or-phone"></div>
                        <input class="input-data" id="input-email-or-phone" type="text" name="email_or_phone" placeholder="Nhập email hoặc số điện thoại" value="<?= $email_or_phone ?? "" ?>" autofocus><br>
                    </div>

                    <div class="input-container">
                        <div class="display-error" id="display-error-passwd"></div>
                        <input class="input-data" id="input-passwd" type="password" name="passwd" placeholder="Nhập mật khẩu" value="<?= $passwd ?? "" ?>"><br>
                    </div>

                    <input class="btn-sign-in" type="submit" value="Đăng nhập">
                    <!-- <input type="reset" value="Reset"> -->
                </form>
            </div>
            
            <div class="admin-form-footer">
                <a class="link-forget-account" href="/manager/main/forget-account.php">
                    Quên tài khoản
                </a>
            </div>
        </div>
    </div>
</body>
</html>