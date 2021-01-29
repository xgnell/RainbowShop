<?php
$notification_title = "Quản lý background";
$return_path = '/manager/backgrounds/background-insert.php';
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/config/default.php");
require_once($root_path . "/manager/backgrounds/background-notification.php");
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

// Lấy dữ liệu
$background = [
    'name' => htmlspecialchars($_POST["name"] ?? null)
];
$background_picture = $_FILES["picture"] ?? null;


// Validate
// Tên
function remove_ascent ($name) {
    if ($name === null) return $name;
    $name = preg_replace("/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ầ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/", "a", $name);
    $name = preg_replace("/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/", "e", $name);
    $name = preg_replace("/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ/", "i", $name);
    $name = preg_replace("/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/", "o", $name);
    $name = preg_replace("/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/", "u", $name);
    $name = preg_replace("/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/", "y", $name);
    $name = preg_replace("/đ|Đ/", "d", $name);
    $name = strtolower($name);
    return $name;
}
$regex_name = "/^(?:[a-zA-Z0-9]+\ ?)+[a-zA-Z0-9]$/";
$background_name = remove_ascent($background['name']);
if ($background['name'] == null || !preg_match($regex_name, $background_name)) {
    display_background_notification_page(
        false,
        $notification_title,
        "Tên không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $background
    );
    exit();
}

// Ảnh
if ($background_picture == null ||
    $background_picture['size'] == 0)
{
    display_background_notification_page(
        false,
        $notification_title,
        "Ảnh background không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $background
    );
    exit();
}
if ($background_picture['size'] > 5000000) {
    display_background_notification_page(
        false,
        $notification_title,
        "Ảnh background phải nhỏ hơn 5MB",
        "",
        "Thử lại",
        $return_path,
        $background
    );
    exit();
}

// Handle picture
$background_picture_name = $background_picture["name"];
move_uploaded_file($background_picture["tmp_name"], "../../public/assets/backgrounds/" . $background_picture_name);

// Insert new background into database
sql_cmd("
    INSERT INTO backgrounds(name, picture)
    VALUES ('{$background['name']}', '$background_picture_name');
");
display_notification_page(
    true,
    $notification_title,
    "Thêm background thành công",
    "",
    "Quay lại",
    "/manager/backgrounds/background-manager.php"
);
exit();