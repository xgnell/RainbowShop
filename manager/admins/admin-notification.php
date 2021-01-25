<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "notification-page.php") {
    display_notification_page(
        false,
        "Quản lý admin",
        "404",
        "Không tìm thấy trang",
        "/manager/main/main-manager.php"
);
}
function display_admin_notification_page($state, $title, $message, $explain, $return_path, $data) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/manager/templates/css/all.css">
        <link rel="stylesheet" href="/manager/templates/css/notification-page-style.css">
    </head>
    <body>
        <?php
            require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/header.php");
        ?>
        <div id="notification-page">
            <div class="container">
                <div class="picture">
                    <?php if ($state == false) { ?>
                        <img src="/public/assets/backgrounds/error-cat.jpg" alt="error">
                    <?php } ?>
                </div>
                <div class="content">
                    <p class="display-message"><?= $message ?></p>
                    <p class="display-explain"><?= $explain ?></p>
                    <?php
                        if ($state == false) {
                            ?>
                            <form action="<?= $return_path ?>" method="POST">
                                <!-- Tên -->
                                <input hidden type="text" name="name" value="<?= $data['name'] ?>">

                                <!-- Giới tính -->
                                <input hidden type="text" name="gender" value="<?= $data['gender'] ?>">
                                    
                                <!-- Ngày tháng năm sinh -->
                                <input hidden type="text" name="birth_year" value="<?= $data['birth_year'] ?>">
                                <input hidden type="text" name="birth_month" value="<?= $data['birth_month'] ?>">
                                <input hidden type="text" name="birth_day" value="<?= $data['birth_day'] ?>">

                                <!-- Điện thoại -->
                                <input hidden type="text" name="phone" value="<?= $data['phone'] ?>">
                                
                                <!-- Email -->
                                <input hidden type="text" name="email" value="<?= $data['email'] ?>">

                                <!-- Mật khẩu -->
                                <input hidden type="password" name="passwd" value="<?= $data['passwd'] ?>">

                                <!-- Quay lại -->
                                <button class="btn-back">Quay lại</button>
                            </form>
                            <?php
                        } else {
                            ?>
                                <button class="btn-back" onclick="window.location.href = '<?= $return_path ?>'">Quay lại</button>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}