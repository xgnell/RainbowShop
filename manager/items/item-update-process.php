<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    //require_once($root_path . "/config/img.php");

    // Get all size in database
    $item_sizes_data_from_db = sql_query("
        SELECT *
        FROM item_sizes;
    ");

    // Get all input data
    $item_id = $_POST["id"];
    $item_name = $_POST["name"];
    
    $item_picture_src = "../../public/img/items/";
    $item_picture_name = "";
    // Get old picture name
    $item_old_picture = sql_query("
        SELECT picture
        FROM items
        WHERE id = $item_id;
    ");
    $item_old_picture = mysqli_fetch_array($item_old_picture);
    if (isset($_FILES["picture"])) {
        // Get new picture from user form input
        $item_picture = $_FILES["picture"];
        // Handle picture
        $item_picture_name = $item_picture["name"];
        move_uploaded_file($item_picture["tmp_name"], $item_picture_src . $item_picture_name);
        // Delete old picture
        unlink($item_picture_src . $item_old_picture["picture"]);
    } else {
        $item_picture_name = $item_old_picture["picture"];
    }
    $item_price = $_POST["price"];
    $item_description = $_POST["description"];
    $item_type_id = $_POST["type"];
    $item_color_id = $_POST["color"];
    
    $item_sizes = [];
    foreach ($item_sizes_data_from_db as $item_size_from_db) {
        $item_sizes[$item_size_from_db["id"]] = $_POST["size-" . $item_size_from_db["id"]];
    }

    // Update selected item
    sql_cmd("
        UPDATE items
        SET name = '$item_name', picture = '$item_picture_name', price = $item_price, description = '$item_description', id_type = $item_type_id, id_color = '$item_color_id'
        WHERE id = $item_id;
    ");

    // Update selected item size data
    $item_details = sql_query("
        SELECT *
        FROM item_details
        WHERE id_item = $item_id;
    ");
    foreach ($item_sizes as $item_size_id => $item_size_amount) {
        foreach ($item_details as $item_data) {
            $found = false;
            if ($item_data["id_size"] == $item_size_id) {
                // If can size name appeared in database
                $found = true;

                if ($item_size_amount == 0) {
                    // Delete size data from database
                    sql_cmd("
                        DELETE FROM item_details
                        WHERE id_item = $item_id AND id_size = '$item_size_id';
                    ");
                } else {
                    // Update size's amount value
                    sql_cmd("
                        UPDATE item_details
                        SET amount = $item_size_amount
                        WHERE id_item = $item_id AND id_size = '$item_size_id';
                    ");
                }

                break;
            }
        }
        if (!$found) {
            // If size name not yet appeared in database
            if ($item_size_amount != 0) {
                sql_cmd("
                    INSERT INTO item_details(id_item, id_size, amount)
                    VALUES ($item_id, '$item_size_id', $item_size_amount);
                ");
            }
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

