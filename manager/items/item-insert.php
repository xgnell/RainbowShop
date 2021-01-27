<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

    define("MENU_OPTION", "item");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Lấy dữ liệu được gửi ngược lại    
    $item_sizes_data_from_db = sql_query("
        SELECT *
        FROM item_sizes;
    ");
    $item = [
        'name' => $_POST["name"] ?? "",
        'price' => $_POST["price"] ?? "",
        'description' => $_POST["description"] ?? "",
        'type_id' => $_POST["type"] ?? "",
        'color_id' => $_POST["color"] ?? ""
    ];

    $item_sizes = [];
    foreach ($item_sizes_data_from_db as $item_size_from_db) {
        $get_size = $_POST["size-" . $item_size_from_db["id"]] ?? "0";
        $item_sizes[$item_size_from_db["id"]] = $get_size;
    }
    $item['sizes'] = $item_sizes;


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
    <script src="/manager/templates/js/common-validate.js"></script>
    <title>Quản lý sản phẩm</title>
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
            <form onsubmit="return validate_all_for_item({
                    'name': [/^(?:[a-zA-Z0-9]+\ ?)+[a-zA-Z0-9]$/, 'Tên không hợp lệ (Không chấp nhận các kí tự đặc biệt)'],
                    'price': null,
                },
                ['type', 'color'],
                ['description', 'picture']);"
                action="/manager/items/item-insert-process.php" method="POST" enctype="multipart/form-data">
                <div style="width: 100%; display: flex;">
                <table class="edit-table">
                    <!-- Tên -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Tên
                        </td>
                        <td>
                            <input id="input-name" type="text" name="name" value="<?= $item['name'] ?>">
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
                            <input id="input-picture" type="file" accept="image/*" name="picture">
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
                            <input id="input-price" type="text" name="price" value="<?= $item['price'] ?>">
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
                            <textarea id="input-description" name="description"><?= $item['description'] ?></textarea>
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
                                <option value="" disabled selected hidden>Chọn loại áo</option>
                                <?php
                                    $item_types = sql_query("
                                        SELECT *
                                        FROM item_types;
                                    ");
                                    foreach ($item_types as $item_type) {
                                        ?>
                                        <option value="<?= $item_type['id'] ?>" <?php if ($item['type_id'] == $item_type['id']) echo "selected"; ?> ><?= $item_type['type'] ?></option>;
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
                            <div style="display: flex;">
                            <div id="display-color" style="border: 1px black solid;"></div>
                            <select name="color" id="select-color" style="width: 250px;" onchange="change_color()">
                                <option value="" disabled selected hidden>Chọn màu</option>
                                <?php
                                    foreach ($item_colors as $item_color) {
                                        ?>
                                        <option value="<?= $item_color['id'] ?>" <?php if ($item['color_id'] == $item_color['id']) echo "selected"; ?> ><?= $item_color['color'] ?></option>
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
                                <input type="submit" value="Thêm sản phẩm">
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
                                    <input id="input-size-<?= $item_size["size"] ?>" name="size-<?= $item_size["id"] ?>" type="text" value="<?= $item['sizes'][$item_size["id"]] ?>">
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
            </form>
        </div>
    </div>
    <script>
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
        change_color();

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
</body>
</html>
