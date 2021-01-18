<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get item id
    $item_id = $_GET["id"];

    // Delete item picture from server
    $item_picture = sql_query("
        SELECT picture
        FROM items
        WHERE id = $item_id;
    ");
    $item_picture_name = mysqli_fetch_array($item_picture)["picture"];
    unlink("../../public/img/items/" . $item_picture_name);

    // Delete item detail data
    sql_cmd("
        DELETE FROM item_details
        WHERE id_item = $item_id
    ");

    // Delete selected item from database
    sql_cmd("
        DELETE FROM items
        WHERE id = $item_id;
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý sản phẩm</title>
</head>
<body>
    <?php include_once($root_path . "/manager/items/item-notification.php") ?>
</body>
</html>
