<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    //require_once($root_path . "/config/img.php");

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
    $item_type = $_POST["type"];
    $item_color = $_POST["color"];
    
    $item_sizes = [];
    foreach ($item_sizes_data_from_db as $item_size_from_db) {
        $item_sizes[$item_size_from_db["size"]] = $_POST["size-" . $item_size_from_db["size"]];
    }

    // Handle picture
    $item_picture_name = $item_picture["name"];
    move_uploaded_file($item_picture["tmp_name"], "../../public/img/items/" . $item_picture_name);

    // Get item type id
    $item_type_id = sql_query("
        SELECT id
        FROM item_types
        WHERE name = '$item_type';
    ");
    $item_type_id = mysqli_fetch_array($item_type_id)["id"];

    // Insert new item into database
    sql_query("
        INSERT INTO items(name, picture, price, description, id_type, color)
        VALUES ('$item_name', '$item_picture_name', $item_price, '$item_description', $item_type_id, '$item_color');
    ");

    /* Insert new information about size */
    // Get the id of the item just inserted
    $item_id = sql_query("
        SELECT MAX(id) as max_id
        FROM items;
    ");
    $item_id = mysqli_fetch_array($item_id)["max_id"];
    // Add size data to database
    foreach ($item_sizes as $item_size_name => $item_size_amount) {
        if (!empty($item_size_amount)) {
            sql_query("
                INSERT INTO item_meta_data (id_item, size, amount)
                VALUES ($item_id, '$item_size_name', $item_size_amount);
            ");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/items/item_notification.php") ?>
</body>
</html>

