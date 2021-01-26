<?php
if (basename($_SERVER['PHP_SELF']) == "display-error-page.php") {
    display_error_page(404, "Không tìm thấy trang");
}
function display_error_page($error_code, $message) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        
        <title><?= $error_code ?></title>
        <link rel="stylesheet" href="/notification/css/error-style.css">
    </head>
    <body>
        <div id="error-page">
            <div class="container">
                <div class="picture">
                    <img src="/public/assets/backgrounds/error-cat.jpg" alt="error">
                </div>
                <div class="content">
                    <p></p>
                    <p class="display-error-code"><?= $error_code ?></p>
                    <p class="display-explain"><?= $message ?></p>
                    <button class="btn-back" onclick="window.history.back()">Quay lại</button>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}