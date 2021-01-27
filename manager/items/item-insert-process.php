<?php
/** Validate
 * Kiểm tra dữ liệu gửi lên từ POST có bị trống ko
 * Kiểm tra tính hợp lệ của dữ liệu (Mấy cái size có thể gộp chung để kiểm tra)
 * Kiểm tra file ảnh có hợp lệ ko
 * Kiểm tra size và price không phải số âm
 * Mã hóa dữ liệu bằng htmlspecialchars
 */
$notification_title = "Quản lý sản phẩm";
$return_path = "/manager/items/item-insert.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/config/default.php");
require_once($root_path . "/manager/items/item-notification.php");
require_once($root_path . "/manager/templates/notification-page.php");

if (empty($_POST)) {
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

// Lấy tất cả size có trong cơ sở dữ liệu
$item_sizes_data_from_db = sql_query("
    SELECT *
    FROM item_sizes;
");
$item = [
    'name' => $_POST["name"] ?? null,
    'price' => $_POST["price"] ?? null,
    'description' => $_POST["description"] ?? null,
    'type_id' => $_POST["type"] ?? null,
    'color_id' => $_POST["color"] ?? null
];
$item_picture = $_FILES["picture"] ?? null;

$item_sizes = [];
foreach ($item_sizes_data_from_db as $item_size_from_db) {
    $get_size = $_POST["size-" . $item_size_from_db["id"]] ?? null;
    $item_sizes[$item_size_from_db["id"]] = $get_size;
}
$item['sizes'] = $item_sizes;



// Kiểm tra tính hợp lệ của dữ liệu
// Kiểm tra tên
$regex_name = "/^(?:[a-zA-Z0-9]+\ ?)+[a-zA-Z0-9]$/";
function remove_ascent ($name) {
    if ($name === null) return $name;
    $name = strtolower($name);
    $name = preg_replace("/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ầ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/", "a", $name);
    $name = preg_replace("/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/", "e", $name);
    $name = preg_replace("/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ/", "i", $name);
    $name = preg_replace("/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/", "o", $name);
    $name = preg_replace("/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/", "u", $name);
    $name = preg_replace("/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/", "y", $name);
    $name = preg_replace("/đ|Đ/", "d", $name);
    return $name;
}
$item_name = remove_ascent($item['name']);
if ($item['name'] == null || !preg_match($regex_name, $item_name)) {
    display_item_notification_page(
        false,
        $notification_title,
        "Tên không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}


// Kiểm tra price
if ($item['price'] == null ||
    !is_numeric($item['price']) ||
    floatval($item['price']) < 0)
{    
    display_item_notification_page(
        false,
        $notification_title,
        "Giá sản phẩm không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}


// Kiểm tra mô tả
if ($item['description'] == null) {
    display_item_notification_page(
        false,
        $notification_title,
        "Mô tả sản phẩm không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}
$item['description'] = htmlspecialchars($item['description']);


// Kiểm tra type id
if ($item['type_id'] == null ||
    !is_numeric($item['type_id']))
{
    display_item_notification_page(
        false,
        $notification_title,
        "Kiểu áo không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}
$item_type = sql_query("
    SELECT *
    FROM item_types
    WHERE id = {$item['type_id']};
");
if (mysqli_num_rows($item_type) != 1) {
    display_item_notification_page(
        false,
        $notification_title,
        "Kiểu áo không tồn tại",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}

// Kiểm tra color id
if ($item['color_id'] == null ||
    !is_numeric($item['color_id']))
{
    display_item_notification_page(
        false,
        $notification_title,
        "Màu áo không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}
$item_color = sql_query("
    SELECT *
    FROM item_colors
    WHERE id = {$item['color_id']};
");
if (mysqli_num_rows($item_color) != 1) {
    display_item_notification_page(
        false,
        $notification_title,
        "Màu áo không tồn tại",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}


// Kiểm tra sizes
foreach ($item["sizes"] as $size_id => $amount) {
    // Lấy tên size
    $size_name = sql_query("
        SELECT size
        FROM item_sizes
        WHERE id = $size_id;
    ");
    $size_name = mysqli_fetch_array($size_name)["size"];
    if ($amount == null || !is_numeric($amount) || intval($amount) < 0) {
        display_item_notification_page(
            false,
            $notification_title,
            "Số lượng size $size_name không hợp lệ",
            "",
            "Thử lại",
            $return_path,
            $item
        );
        exit();
    }

}

// Kiểm tra ảnh
/** Có thể kiểm tra các yếu tố sau
 * Phần mở rộng của file
 * Kiểu file
 * Kích thước tối đa của file
 * Độ lớn tối đa của file
 * 
 */
if ($item_picture == null ||
    $item_picture['size'] == 0)
{
    display_item_notification_page(
        false,
        $notification_title,
        "Ảnh sản phẩm không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}
if ($item_picture['size'] > 1000000)
{
    display_item_notification_page(
        false,
        $notification_title,
        "Ảnh đại diện sản phẩm phải nhỏ hơn 1MB",
        "",
        "Thử lại",
        $return_path,
        $item
    );
    exit();
}
// Tải ảnh lên server
$item_picture_name = $item_picture["name"];
move_uploaded_file($item_picture["tmp_name"], "../.." . ITEM_IMAGE_SOURCE_PATH . $item_picture_name);




// Insert new item into database
sql_cmd("
    INSERT INTO items(
        name,
        picture,
        price,
        description,
        id_type,
        id_color
    )
    VALUES (
        '{$item["name"]}',
        '$item_picture_name',
        {$item["price"]},
        '{$item["description"]}',
        {$item["type_id"]},
        '{$item["color_id"]}'
    );
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
display_notification_page(
    true,
    $notification_title,
    "Thêm sản phẩm thành công",
    "",
    "Quay lại",
    "/manager/items/items-manager.php",
);