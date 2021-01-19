<?php
    define("MENU_OPTION", "item");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/img.php");
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
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <style>
        #display-size {
            width: 100%;
            border: 1px #ccc solid;
            border-collapse: collapse;
            /* margin: 5px 5px 5px 5px; */
        }
        #display-size tr th {
            border: 1px #ccc solid;
            padding: 5px 5px 5px 5px;
        }
        #display-size tr td {
            border: 1px #ccc solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <div class="page-menu">
            <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        </div>
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
                <tr class="table-bar-header" style="top: 0;">
                    <td>Tên</td>
                    <td>Ảnh</td>
                    <td>Mô tả</td>
                    <td>Giá (VNĐ)</td>
                    <td>Loại</td>
                    <td>Màu</td>
                    <td>Số lượng</td>


                    <td>Sửa</td>
                    <td>Xóa</td>
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
                        <td><img style="height: 100px;" src="<?= ITEM_IMAGE_SOURCE_PATH . $item['picture'] ?>"></td>
                        <td><?= $item['description'] ?></td>
                        <td>
                            <?= number_format($item['price'], 0, ',', '.') ?>
                        </td>
                        <td><?= $item_type ?></td>
                        <td>
                            <div style="
                                    display: inline-block;
                                    width: 20px; height: 20px;
                                    background-color: <?= $item_color ?>;
                                    <?php
                                        if ($item_color == 'white')
                                            echo 'border: 1px black solid;';
                                    ?>">
                            </div>
                        </td>
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
                                    <!-- <td>Size</td> -->
                                    <?php
                                        foreach ($item_sizes as $item_size) {
                                            ?>
                                            <th><?= $item_size["size"] ?></th>
                                            <?php
                                        }
                                    ?>
                                </tr>
                                <tr>
                                    <!-- <td>Amount</td> -->
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
                        <td>
                            <a class="btn-action" href="/manager/items/item-update.php?id=<?= $item['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                            </a>
                        </td>
                        <td>
                            <a class="btn-action" href="/manager/items/item-delete-process.php?id=<?= $item['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr class="table-bar-footer" style="bottom: 0;">
                    <td colspan="9">
                        <a href="">1</a>
                        <a href="">2</a>
                        <a href="">3</a>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>
