<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "item-notification.php") {
    display_notification_page(
        false,
        "Quản lý sản phẩm",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước đó
);
}
function display_item_notification_page(
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
                    
                                <!-- Ảnh -->
                                <!-- <input hidden type="file" accept="image/*" name="picture" value="<?= $data[''] ?>"> -->
                            
                                <!-- Giá -->
                                <input hidden type="text" name="price" value="<?= $data['price'] ?>">
                            
                                <!-- Mô tả -->
                                <input hidden type="text" name="description" value="<?= $data['description'] ?>">
                                
                                <!-- Loại -->
                                <input hidden type="text" name="type" value="<?= $data['type_id'] ?>">

                                <!-- Màu -->
                                <input hidden type="text" name="color" value="<?= $data['color_id'] ?>">

                                <!-- Size -->
                                <?php
                                    // Get item all size types
                                    $item_sizes = sql_query("
                                        SELECT *
                                        FROM item_sizes;
                                    ");

                                    foreach ($item_sizes as $item_size) {
                                        ?>
                                        <input hidden type="text" name="size-<?= $item_size['id'] ?>" value="<?= $data['sizes'][$item_size['id']] ?>">
                                        <?php
                                    }
                                ?>

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