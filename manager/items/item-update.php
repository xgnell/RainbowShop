<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/img.php");
    $item_picture_src = IMG_SRC . "items/";

    // Get selected item
    $item_id = $_GET["id"];
    $item = sql_query("
        SELECT *
        FROM items
        WHERE id = $item_id;
    ");
    $item = mysqli_fetch_array($item);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
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
            <!-- Item update form -->
            <form action="/manager/items/item-update-process.php" method="POST" enctype="multipart/form-data">
                <input type="number" name="id" value="<?= $item_id ?>" hidden><br>
                Name: <input type="text" name="name" value="<?= $item["name"] ?>"><br>
                Picture: <input type="button" id="btn-change-picture" onclick="change_picture()" value="Change picture">
                <div id="display-picture">
                    <img width="500px" src="<?= $item_picture_src . $item["picture"] ?>">
                    <!-- <input type="file" name="picture"> -->
                </div>
                <br>
                Price: <input type="number" name="price" value="<?= $item["price"] ?>"><br>
                Description: <textarea name="description" cols="50" rows="5"><?= $item["description"] ?></textarea><br>
                Type: <select name="type" id="display-type">
                    <!-- Auto generate item type options -->
                    <?php
                        $item_types = sql_query("
                            SELECT *
                            FROM item_types;
                        ");
                        foreach($item_types as $item_type) {
                            ?>
                            <option value="<?= $item_type['id'] ?>" <?php if($item_type['id'] == $item['id_type']) echo "selected" ?> ><?= $item_type['type'] ?></option>;
                            <?php
                        }
                    ?>
                </select><br>
                Color: <select name="color" id="display-color">
                    <!-- Auto generate item color options -->
                    <?php
                        $item_colors = sql_query("
                            SELECT *
                            FROM item_colors;
                        ");
                        foreach ($item_colors as $item_color) {
                            ?>
                            <option value="<?= $item_color['id'] ?>" <?php if ($item_color['id'] == $item['id_color']) echo "selected" ?> ><?= $item_color['color'] ?></option>
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

                    // Get all item detail data
                    $item_details = sql_query("
                        SELECT *
                        FROM item_details
                        WHERE id_item = {$item["id"]};
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
                                <td>
                                    <?php
                                        $found = false;
                                        foreach ($item_details as $item_data) {
                                            if ($item_data["id_size"] == $item_size["id"]) {
                                                $found = true;
                                                echo "<input name=\"size-{$item_size["id"]}\" type=\"number\" value=\"{$item_data["amount"]}\">";
                                                break;
                                            }
                                        }
                                        if (!$found) {
                                            echo "<input name=\"size-{$item_size["id"]}\" type=\"number\" value=\"0\">";
                                        }
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>
                </table>

                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </form>
            <script defer>
                // Create picture input if user want to change    
                let is_display_old_picture = true;
                let display_picture = document.getElementById('display-picture');
                let btn_change_picture = document.getElementById('btn-change-picture');
                function change_picture() {
                    if (is_display_old_picture) {
                        is_display_old_picture = false;

                        btn_change_picture.value = 'Use previous picture';
                        display_picture.innerHTML = '<input type="file" name="picture">';
                    } else {
                        is_display_old_picture = true;
                        
                        btn_change_picture.value = 'Change picture';
                        display_picture.innerHTML = '<img width="500px" src="<?= $item_picture_src . $item["picture"] ?>">';
                    }
                }
            </script>
        </div>
    </div>
</body>
</html>
