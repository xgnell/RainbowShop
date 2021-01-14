<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "qna");
require_once($root_path . "/public/templates/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");
include_once($root_path . "/public/templates/item.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỏi đáp</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
    <style>
        .panel {
            margin: 30px 10% 30px 10%;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            min-height: 300px;
        }

        .notification {
            width: 100%;
            padding: 10%;
            text-align: center;
        }
        .notification * {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>  
    <?php require_once($root_path . '/public/templates/header.php'); ?>
    <?php require_once($root_path . '/public/templates/menu.php'); ?>
    
    <div class="panel">
        <div class="notification">
            <h2>Chúng tôi đang trong quá trình biên soạn câu hỏi</h2>
            <h3>Mời bạn vui lòng quay lại sau!</h3>
        </div>
    </div>

    <?php require_once($root_path . '/public/templates/footer.php'); ?>
</body>
</html>