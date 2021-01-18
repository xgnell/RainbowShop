<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "contact");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/item/item.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
</head>
<body style="background-color: #999999;">
    <?php require_once($root_path . '/public/templates/ui/header.php'); ?>
    <?php require_once($root_path . '/public/templates/ui/menu.php'); ?>
    <?php require_once($root_path . '/public/templates/ui/footer.php'); ?>
</body>
</html>