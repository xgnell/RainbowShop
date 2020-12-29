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
    <link rel="icon" href="/public/img/socials/rk.png">
    <style>
        .disp-items>div {
            display: flex;
            justify-content: space-between;
            /* margin: 20px 20px 20px 20px;
            background-color: white;
            border-radius: 7px; */
        }

        .panel {
            margin: 30px 10% 30px 10%;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <?php include_once($root_path . "/public/templates/header.php"); ?>
        </div>

        <div class="menu">
            <?php include_once($root_path . "/public/templates/menu.php"); ?>
        </div>
        <!-- <div>
            <?php include_once($root_path . "/public/templates/background.php"); ?>
        </div> -->
        <div>
            <?php include_once($root_path . "/public/templates/sign-in.php"); ?>
        </div>
    
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
        
        <!--///////////////  Here is include footer /////////////-->
        <div>
            <?php include_once($root_path . "/public/templates/footer.php"); ?>
        </div>
    </div>
</body>
</html>