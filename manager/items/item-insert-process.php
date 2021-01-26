<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get all size in database
    $item_sizes_data_from_db = sql_query("
        SELECT *
        FROM item_sizes;
    ");

    // Get all input data
    $item_name = $_POST["name"];
    $item_picture = $_FILES["picture"];
    $item_price = $_POST["price"];
    $item_description = $_POST["description"];
    $item_type_id = $_POST["type"];
    $item_color_id = $_POST["color"];
    
    $item_sizes = [];
    foreach ($item_sizes_data_from_db as $item_size_from_db) {
        $item_sizes[$item_size_from_db["id"]] = $_POST["size-" . $item_size_from_db["id"]];
    }

    // Handle picture
    $item_picture_name = $item_picture["name"];
    move_uploaded_file($item_picture["tmp_name"], "../../public/img/items/" . $item_picture_name);

    // Insert new item into database
    sql_cmd("
        INSERT INTO items(name, picture, price, description, id_type, id_color)
        VALUES ('$item_name', '$item_picture_name', $item_price, '$item_description', $item_type_id, '$item_color_id');
    ");

    /* Insert new information about size */
    // Get the id of the item just inserted
    $item_id = sql_query("
        SELECT MAX(id) as max_id
        FROM items;
    ");
    $item_id = mysqli_fetch_array($item_id)["max_id"];
    // Add size data to database
    foreach ($item_sizes as $item_size_id => $item_size_amount) {
        if (!empty($item_size_amount)) {
            sql_cmd("
                INSERT INTO item_details (id_item, id_size, amount)
                VALUES ($item_id, '$item_size_id', $item_size_amount);
            ");
        }
    }

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

