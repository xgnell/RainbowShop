<?php
    define("MENU_OPTION", "item");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/img.php");
    $item_picture_src = IMG_SRC . "items/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items manager</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <style>
        #display-size {
            border: 1px black solid;
            border-collapse: collapse;
            margin: 5px 5px 5px 5px;
        }
        #display-size tr td {
            border: 1px black solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <?php
                // Get all items
                $items = sql_query("
                    SELECT *
                    FROM items;
                ");
            ?>
            <div class="scrollable">
            <table id="content-table">
                <tr>
                    <td class="title">Name</td>
                    <td class="title">Picture</td>
                    <td class="title">Description</td>
                    <td class="title">Price</td>
                    <td class="title">Type</td>
                    <td class="title">Color</td>
                    <td class="title">Amount</td>


                    <td class="title">Update</td>
                    <td class="title">Delete</td>
                </tr>
                <?php foreach($items as $item): ?>
                    <?php
                        // Get item type
                        $item_type = sql_query("
                            SELECT type
                            FROM item_types
                            WHERE id = {$item["id_type"]};
                        ");
                        $item_type = mysqli_fetch_array($item_type)["type"];

                        // Get item color
                        $item_color = sql_query("
                            SELECT color
                            FROM item_colors
                            WHERE id = {$item["id_color"]};
                        ");
                        $item_color = mysqli_fetch_array($item_color)["color"];

                        // Get all item detail data
                        $item_details = sql_query("
                            SELECT *
                            FROM item_details
                            WHERE id_item = {$item["id"]};
                        ");
                    ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><img style="height: 100px;" src="<?= $item_picture_src . $item['picture'] ?>"></td>
                        <td><?= $item['description'] ?></td>
                        <td><?= $item['price'] ?> VNĐ</td>
                        <td><?= $item_type ?></td>
                        <td><?= $item_color ?></td>
                        <td>
                            <?php
                                // Get item all size types
                                $item_sizes = sql_query("
                                    SELECT *
                                    FROM item_sizes;
                                ");
                            ?>
                            <table id="display-size">
                                <tr>
                                    <td>Size</td>
                                    <?php
                                        foreach ($item_sizes as $item_size) {
                                            ?>
                                            <td><?= $item_size["size"] ?></td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <?php
                                        foreach ($item_sizes as $item_size) {
                                            // Find if size exist in list of items
                                            $found_item = false;
                                            foreach ($item_details as $item_data) {
                                                if ($item_data["id_size"] == $item_size["id"]) {
                                                    $found_item = true;
                                                    ?>
                                                    <td><?= $item_data["amount"] ?></td>
                                                    <?php
                                                    break;
                                                }
                                            }
                                            if (!$found_item) {
                                                ?>
                                                <td>0</td>
                                                <?php
                                            }
                                        }
                                    ?>
                                </tr>
                            </table>
                        </td>
                        <td><a href="/manager/items/item-update.php?id=<?= $item['id'] ?>">Update</a></td>
                        <td><a href="/manager/items/item-delete-process.php?id=<?= $item['id'] ?>">Delete</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
            </div>
        </div>
    </div>
</body>
</html>
