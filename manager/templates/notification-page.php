<?php
function display_notification_page($state, $title, $message, $explain, $return_path = null) {
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
                    <?php if ($state == false) { ?>
                        <p>Oh no, oh no, no no no no no no!</p>
                    <?php } ?>
                    <p class="display-message"><?= $message ?></p>
                    <p class="display-explain"><?= $explain ?></p>
                    <?php
                        if ($return_path == null) {
                            ?>
                            <button class="btn-back" onclick="window.history.back()">Quay lại</button>
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