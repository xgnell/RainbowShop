<?php
$notification_title = "Quản lý sản phẩm";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/config/default.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Get item id
$item_id = $_GET["id"] ?? null;
if ($item_id == null || !is_numeric($item_id)) {
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
$item_id_db = sql_query("
    SELECT *
    FROM items
    WHERE id = $item_id;
");
if (mysqli_num_rows($item_id_db) != 1) {
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

// Delete item picture from server
$item_picture = sql_query("
    SELECT picture
    FROM items
    WHERE id = $item_id;
");
$item_picture_name = mysqli_fetch_array($item_picture)["picture"];
unlink("../.." . ITEM_IMAGE_SOURCE_PATH . $item_picture_name);

// Delete item detail data
sql_cmd("
    DELETE FROM item_details
    WHERE id_item = $item_id
");

// Delete selected item from database
sql_cmd("
    DELETE FROM items
    WHERE id = $item_id;
");
display_notification_page(
    false,
    $notification_title,
    "Xóa sản phẩm thành công",
    "",
    "Quay lại",
    "/manager/items/items-manager.php"
);
exit();