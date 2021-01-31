<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/public/templates/ui/notification/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "signup-notification.php") {
    display_front_notification_page(
        false,
        "Rainbow Kitty",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước đó
    );
    exit();
}
function display_signup_notification_page(
    $state,
    $title,
    $message,
    $explain,
    $return_title,
    $return_path,
    $data)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/public/templates/css/all.css">
        <link rel="stylesheet" href="/public/templates/ui/notification/notification-page-style.css">
    </head>
    <body>
        <?php
            $root_path = $_SERVER["DOCUMENT_ROOT"];
            require_once($root_path . "/public/templates/ui/header.php");
            require_once($root_path . "/public/templates/ui/menu.php");
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

                                <!-- Địa chỉ -->
                                <input hidden type="text" name="address" value="<?= $data['address'] ?>">

                                <!-- Quay lại -->
                                <button class="btn-back"><?= $return_title ?></button>
                            </form>
                            <?php
                        } else {
                            ?>
                                <button class="btn-back" onclick="window.location.href = '<?= $return_path ?>'"><?= $return_title ?></button>
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