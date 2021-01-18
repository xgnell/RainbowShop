<?php
    define("MENU_OPTION", "item");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Quản lý sản phẩm</title>
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
            <!-- Item insertion form -->
            <form action="/manager/items/item-insert-process.php" method="POST" enctype="multipart/form-data">
                Tên: <input type="text" name="name"><br>
                Ảnh: <input type="file" name="picture"><br>
                Giá: <input type="number" name="price"><br>
                Mô tả: <textarea name="description" cols="50" rows="5"></textarea><br>
                Loại: <select name="type" id="display-type">
                    <!-- Auto generate item type options -->
                    <?php
                        $item_types = sql_query("
                            SELECT *
                            FROM item_types;
                        ");
                        foreach ($item_types as $item_type) {
                            ?>
                            <option value="<?= $item_type['id'] ?>"><?= $item_type['type'] ?></option>;
                            <?php
                        }
                    ?>
                </select><br>
                Màu: <select name="color" id="display-color">
                    <!-- Auto generate item color options -->
                    <?php
                        $item_colors = sql_query("
                            SELECT *
                            FROM item_colors;
                        ");
                        foreach ($item_colors as $item_color) {
                            ?>
                            <option value="<?= $item_color['id'] ?>"><?= $item_color['color'] ?></option>
                            <?php
                        }
                    ?>
                </select><br>
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
                        <td>Số lượng</td>
                        <?php
                            foreach ($item_sizes as $item_size) {
                                ?>
                                <td><input name="size-<?= $item_size["id"] ?>" type="number"></td>
                                <?php
                            }
                        ?>
                    </tr>
                </table>

                <input type="submit" value="Thêm sản phẩm">
                <input type="reset" value="Làm lại">
            </form>
        </div>
    </div>
</body>
</html>
