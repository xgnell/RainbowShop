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
</head>

<body>
        <div>
            <?php include_once($root_path . "/public/templates/header.php"); ?>
        </div>

        <div class="menu">
            <?php include_once($root_path . "/public/templates/menu.php"); ?>
        </div>
        <div>
            <?php include_once($root_path . "/public/templates/background.php"); ?>
        </div>
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

        <?php include_once($root_path . "/public/templates/disp-item.php"); ?>
        
        <!--///////////////  Here is include footer /////////////-->
        <div>
            <?php include_once($root_path . "/public/templates/footer.php"); ?>
        </div>
</body>
</html>