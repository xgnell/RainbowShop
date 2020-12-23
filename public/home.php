<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <style>
        .disp-items>div {
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
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    define("PAGE_NAME", "home");
    include_once("templates/header.php");
    include_once("templates/item.php");
    require_once($root_path . "/config/db.php");
    ?>
    <?php include_once("templates/slide-menu.php"); ?>
    <div class="disp-items panel">
        <div class="disp-new-items">
        <!-- Day la doan connect voi csdl -->
            <?php
            $img_folder = 'public/img/items/';
            // include 'templates/connect.php';
            // $sql = 'select picture * price from items';
            // $result = mysqli_query($connect, $sql);
            $result = sql_query('select picture , price from items');
            ?>
            <?php foreach ($result as $each) : ?>
                <?php spawn_item($img_folder . $each['picture'], $each['price'].'$');
            ?>
            <?php endforeach ?>
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