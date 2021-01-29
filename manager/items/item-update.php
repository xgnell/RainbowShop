<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

    define("MENU_OPTION", "item");
    $notification_title = "Quản lý sản phẩm";
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/default.php");
    require_once($root_path . "/manager/templates/notification-page.php");

    // Get selected item
    $item_id = $_GET["id"] ?? null;
    if ($item_id == null) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay về trang trước đó
        );
        exit();
    }
    if (!is_numeric($item_id)) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay lại trang trước đó
        );
        exit();
    }
    $id_db = sql_query("
        SELECT *
        FROM items
        WHERE id = $item_id;
    ");
    if (mysqli_num_rows($id_db) != 1) {
        display_notification_page(
            false,
            $notification_title,
            "404",
            "Không tìm thấy trang",
            "Quay lại"
            // Quay về trang trước đó
        );
        exit();
    }


    $item = null;
    if (!empty($_POST)) {
        // Lấy dữ liệu được gửi ngược lại
        $item_sizes_data_from_db = sql_query("
            SELECT *
            FROM item_sizes;
        ");
        $item = [
            'name' => $_POST["name"] ?? "",
            'price' => $_POST["price"] ?? "",
            'description' => $_POST["description"] ?? "",
            'id_type' => $_POST["type"] ?? "",
            'id_color' => $_POST["color"] ?? ""
        ];
    
        $item_sizes = [];
        foreach ($item_sizes_data_from_db as $item_size_from_db) {
            $get_size = $_POST["size-" . $item_size_from_db["id"]] ?? "0";
            $item_sizes[$item_size_from_db["id"]] = $get_size;
        }
        $item['sizes'] = $item_sizes;

        $item['picture'] = sql_query("
            SELECT picture
            FROM items
            WHERE id = $item_id;
        ");
        $item['picture'] = mysqli_fetch_array($item['picture'])["picture"];
    } else {
        $item = sql_query("
            SELECT *
            FROM items
            WHERE id = $item_id;
        ");
        $item = mysqli_fetch_array($item);
    } 

    // Xu ly van de ve anh

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
    <script src="/manager/templates/js/common-validate.js"></script>
    <style>
        #btn-change-picture {
            margin-bottom: 5px;
            cursor: pointer;
            border: 1px #32373c solid;
            background-color: #dedede;
            /* height: 40px; */
        }
        #btn-change-picture:hover {
            background-color: #ccc;
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
            <form onsubmit="return validate_all_for_item({
                    'name': [/^(?:[a-zA-Z0-9]+\ ?)+[a-zA-Z0-9]$/, 'Tên không hợp lệ (Không chấp nhận các kí tự đặc biệt)'],
                    'price': null,
                },
                ['type', 'color'],
                ['description']);"
                action="/manager/items/item-update-process.php" method="POST" enctype="multipart/form-data">
                <input type="number" name="id" value="<?= $item_id ?>" hidden><br>
                <div style="width: 100%; display: flex;">
                    <table class="edit-table">
                        <!-- Tên -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Tên
                            </td>
                            <td>
                                <input id="input-name" type="text" name="name" value="<?= $item["name"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-name"></td>
                        </tr>

                        <!-- Ảnh -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Ảnh
                            </td>
                            <td>
                                <input id="btn-change-picture" type="button" onclick="change_picture()" value="Change picture">
                                <div id="display-picture">
                                    <img width="300px" src="<?= ITEM_IMAGE_SOURCE_PATH . $item["picture"] ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-picture"></td>
                        </tr>

                        <!-- Giá -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Giá
                            </td>
                            <td>
                                <input id="input-price" type="number" name="price" value="<?= $item["price"] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-price"></td>
                        </tr>

                        <!-- Mô tả -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Mô tả
                            </td>
                            <td>
                                <textarea id="input-description" name="description" cols="50" rows="5"><?= $item["description"] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-description"></td>
                        </tr>

                        <!-- Loại -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Loại
                            </td>
                            <td>
                                <select name="type" id="select-type">
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
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-type"></td>
                        </tr>

                        <!-- Màu -->
                        <tr>
                            <td class="table-title" rowspan="2">
                                Màu
                            </td>
                            <td>
                                <script>
                                    let color_data = <?php
                                        // Lấy dữ liệu màu
                                        $item_colors = sql_query("
                                            SELECT *
                                            FROM item_colors;
                                        ");
                                        $color_data = [];
                                        foreach ($item_colors as $item_color) {
                                            $color_data[] = $item_color;
                                        }

                                        echo json_encode($color_data);
                                    ?>;
                                </script>
                                <?php
                                    $item_color_code = sql_query("
                                        SELECT code
                                        FROM item_colors
                                        WHERE id = {$item["id_color"]};
                                    ");
                                    $item_color_code = mysqli_fetch_array($item_color_code)["code"];
                                ?>
                                <div style="display: flex;">
                                <div id="display-color" style="
                                    background-color: <?= $item_color_code ?>;
                                    <?php if ($item_color_code == 'white') echo 'border: 1px black solid;'; ?>
                                ">
                                </div>
                                <select name="color" id="select-color" style="width: 250px;" onchange="change_color()">
                                    <?php
                                        foreach ($item_colors as $item_color) {
                                            ?>
                                            <option value="<?= $item_color['id'] ?>" <?php if ($item_color['id'] == $item['id_color']) echo "selected" ?> ><?= $item_color['color'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="display-error" id="display-error-color"></td>
                        </tr>

                        <!-- Action -->
                        <tr>
                            <td colspan="2">
                                <div class="action-area">
                                    <input type="submit" value="Xác nhận sửa">
                                    <input type="reset" value="Làm lại">
                                </div>
                            </td>
                        </tr>

                    </table>
                    


                    <?php
                        // Get item all size types
                        $item_sizes = sql_query("
                            SELECT *
                            FROM item_sizes;
                        ");


                        $item_details = [];
                        if (empty($item['sizes'])) {
                            // Get all item detail data
                            $item_details = sql_query("
                                SELECT *
                                FROM item_details
                                WHERE id_item = {$item["id"]};
                            ");
                        } else {
                            foreach ($item['sizes'] as $size_id => $amount) {
                                array_push($item_details, [
                                    'id_size' => $size_id,
                                    'amount' => $amount
                                ]);
                            }
                        }
                    ?>
                    <table class="size-table">
                        <!-- Phần title -->
                        <tr>
                            <td class="table-title">
                                Size
                            </td>
                            <td class="table-title">
                                Số lượng
                            </td>
                        </tr>
                        
                        <?php
                            foreach ($item_sizes as $item_size) {
                                ?>
                                <tr>
                                    <td class="table-title" rowspan="2">
                                        <?= $item_size["size"] ?>
                                    </td>
                                    <td>
                                        <?php
                                            $found = false;
                                            foreach ($item_details as $item_data) {
                                                if ($item_data["id_size"] == $item_size["id"]) {
                                                    $found = true;
                                                    ?>
                                                        <input id="input-size-<?= $item_size['size'] ?>" name="size-<?= $item_size["id"] ?>" type="number" value="<?= $item_data["amount"] ?>">
                                                    <?php
                                                    break;
                                                }
                                            }
                                            if (!$found) {
                                                ?>
                                                <input id="input-size-<?= $item_size["size"] ?>" name="size-<?= $item_size["id"] ?>" type="number" value="0">

                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="display-error" id="display-error-size-<?= $item_size["size"] ?>"></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>

                </table>

                
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
                        display_picture.innerHTML = '<input type="file" id="input-picture" name="picture">';
                    } else {
                        is_display_old_picture = true;
                        
                        btn_change_picture.value = 'Change picture';
                        display_picture.innerHTML = '<img width="300px" src="<?= ITEM_IMAGE_SOURCE_PATH . $item["picture"] ?>">';
                    }
                }

                let select_color = document.getElementById('select-color');
                let display_color = document.getElementById('display-color');
                function change_color() {
                    let current_color_id = select_color.value;
                    for (color of color_data) {
                        if (current_color_id === color["id"]) {
                            display_color.style.backgroundColor = color["code"];
                            if (color["code"] === 'white') {
                                display_color.style.border = '1px black solid';
                            } else {
                                display_color.style.border = '0';
                            }
                            break;
                        }
                    }
                }

                function is_valid_size() {
                    let is_passed = true;
                    <?php foreach ($item_sizes as $item_size): ?>
                        {
                            let inside_passed = true;
                            let input = document.getElementById(`input-size-<?= $item_size["size"] ?>`);
                            let error = document.getElementById(`display-error-size-<?= $item_size["size"] ?>`);
                            
                            if (!is_not_blank(input, error)) {
                                if (inside_passed) inside_passed = false;
                            }

                            // Kiểm tra số lượng có phải số không
                            if (isNaN(input.value)) {
                                display_error(input, error, "Size phải là số");
                                if (inside_passed) inside_passed = false;
                            }

                            // Kiểm tra số lượng ko âm
                            if (parseFloat(input.value) < 0) {
                                display_error(input, error, "Size không thể là số âm");
                                if (inside_passed) inside_passed = false;
                            }

                            if (inside_passed) {
                                display_error(input, error, '');
                            } else {
                                if (is_passed) is_passed = false;
                            }
                        }
                    <?php endforeach ?>
                    return is_passed;
                }
                function validate_all_for_item(regex_list, select_list, textarea_list = null) {
                    let is_passed = validate_all(regex_list, select_list, textarea_list);

                    if (!is_valid_size()) {
                        if (is_passed) is_passed = false;
                    }

                    return is_passed;
                }
            </script>
        </div>
    </div>
</body>
</html>
