<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

define("PAGE_NAME", "home");
require_once($root_path . "/public/templates/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");
include_once($root_path . "/public/templates/item.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rainbow fashion</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <link rel="icon" href="/public/img/socials/logo_1.png">
    <style>
        /* .disp-items>div {
            display: flex;
            justify-content: space-between;
            margin: 20px 20px 20px 20px;
            padding: 10px 5px 10px 5px;
            background-color: white;
            border-radius: 7px;
            height: 450px;
            min-width: 800;
        }

        .panel {
            margin: 30px 10% 30px 10%;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        } */
    </style>
</head>

<body>
    <?php include_once($root_path . "/public/templates/header.php"); ?>

    <?php include_once($root_path . "/public/templates/menu.php"); ?>

    <?php include_once($root_path . "/public/templates/background.php"); ?>

    <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

    <?php
    $item_data = sql_query("
                SELECT id
                FROM items
                LIMIT 4;
            ");
    ?>

    <?php include_once($root_path . "/public/templates/disp-item.php"); ?>

    <?php include_once($root_path . "/public/templates/counselor.php"); ?>

    <!--///////////////  Here is include footer /////////////-->
    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>

</html>