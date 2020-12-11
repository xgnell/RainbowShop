<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
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

    // Delete selected item from database
    sql_query("
        DELETE FROM items
        WHERE id = $item_id;
    ");

    // Delete item meta data
    sql_query("
        DELETE FROM item_meta_data
        WHERE id_item = $item_id
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Delete Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/items/item_notification.php") ?>
</body>
</html>
