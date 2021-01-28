<?php
if (basename($_SERVER['PHP_SELF']) == "notification-page.php") {
    display_front_notification_page(
        false,
        "Rainbow Kitty",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước
    );
    exit();
}
function display_front_notification_page(
    $state,
    $title,
    $message,
    $explain,
    $return_title = null,
    $return_path = null)
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
                        if ($return_path == null) {
                            ?>
                            <button class="btn-back" onclick="window.history.back()"><?= $return_title ?></button>
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