<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <style>
        .disp-items > div {
            display: flex;
            justify-content: space-between;
            /* margin: 20px 20px 20px 20px;
            background-color: white;
            border-radius: 7px; */
        }
        .panel {
            margin: 30px 30px 30px 30px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        }
    </style>
</head>
<body>
    <?php
        include_once("templates/header.php");
        include_once("templates/item.php");
    ?>
    <?php include_once("templates/slide-menu.php"); ?>
    <div class="disp-items panel">
        <div class="disp-new-items">
        <?php
            for ($i = 0; $i < 4; $i++) {
                spawn_item("/public/img/items/shirt.jpg", "10000$");
            }
        ?>
        </div>
        <div class="disp-polular-items">
        <?php
            for ($i = 0; $i < 4; $i++) {
                spawn_item("/public/img/items/shirt.jpg", "50000$");
            }
        ?>
        </div>
    </div>
    <div class="disp-staff panel">
        <?php include_once("templates/counselor.php"); ?>
    </div>
    <?php include_once("templates/footer.php"); ?>
</body>
</html>
