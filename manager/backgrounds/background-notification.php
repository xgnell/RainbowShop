<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "background-notification.php") {
    display_notification_page(
        false,
        "Quản lý background",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước đó
);
}
function display_background_notification_page(
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