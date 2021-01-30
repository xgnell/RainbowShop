<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    require_once($root_path . "/config/db.php");

    $phone = sql_query("
        SELECT *
        FROM contact
        WHERE id = 1;
    ");
    $phone = mysqli_fetch_array($phone)['value'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">

    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <title>Quên tài khoản</title>
    <style>
        #forget-account {
            --background-color-all: #f1f1f1;

            position: fixed;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--background-color-all);
        }

        #forget-account div {
            color: red;
            margin-top: -100px;
        }
    </style>
</head>
<body>
    <div id="forget-account">
        <div>
            <h3>Vui lòng liên hệ lại theo số <?= $phone ?> để thực hiện các bước lấy lại tài khoản</h3>
        </div>
    </div>
</body>
</html>