<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Add Item</title>
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
                Enter name: <input type="text" name="name"><br>
                Choose picture: <input type="file" name="picture"><br>
                Enter price: <input type="number" name="price"><br>
                Enter description: <textarea name="description" cols="50" rows="5"></textarea><br>
                Choose type: <select name="type" id="display-type">
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
                Choose color: <select name="color" id="display-color">
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
                        <td>Amount</td>
                        <?php
                            foreach ($item_sizes as $item_size) {
                                ?>
                                <td><input name="size-<?= $item_size["id"] ?>" type="number"></td>
                                <?php
                            }
                        ?>
                    </tr>
                </table>

                <input type="submit" value="Add">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
</body>
</html>
