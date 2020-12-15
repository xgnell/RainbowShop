<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    include_once($root_path . "/public/templates/item.php");

    require_once($root_path . "/config/db.php");

?>
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
    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/slide-menu.php"); ?>
    <?php
        $item_data = sql_query("
            SELECT id
            FROM items
            LIMIT 4;
        ");
    ?>
    <div class="disp-items panel">
        <div class="disp-new-items">
            <?php
                foreach ($item_data as $item) {
                    spawn_item($item["id"]);
                }
            ?>
        </div>
        <!-- <div class="disp-polular-items">
            <?php
                for ($i = 0; $i < 4; $i++) {
                    spawn_item("");
                }
            ?>
        </div> -->
    </div>
    <div class="disp-staff panel">
        <?php include_once($root_path . "/public/templates/counselor.php"); ?>
    </div>
    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>