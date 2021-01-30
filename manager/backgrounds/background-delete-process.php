<?php
$notification_title = "Quản lý background";
$return_path = '/manager/backgrounds/background-manager.php';
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/config/default.php");
require_once($root_path . "/manager/backgrounds/background-notification.php");
require_once($root_path . "/manager/templates/notification-page.php");


// Get background id
$background_id = $_GET["id"] ?? null;

// Validate
if ($background_id == null || !is_numeric($background_id)) {
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
$background_id_db = sql_query("
    SELECT *
    FROM backgrounds
    WHERE id = $background_id;
");
if (mysqli_num_rows($background_id_db) != 1) {
    display_notification_page(
        false,
        $notification_title,
        "Background không tồn tại",
        "",
        "Thử lại",
        $return_path,
        $background
    );
    exit();
}


// Delete picture from server
$background_picture = sql_query("
    SELECT picture
    FROM backgrounds
    WHERE id = $background_id;
");
$background_picture_name = mysqli_fetch_array($background_picture)["picture"];
unlink("../.." . ITEM_IMAGE_SOURCE_PATH . $background_picture_name);

// Delete selected background from database
sql_cmd("
    DELETE FROM backgrounds
    WHERE id = $background_id;
");
header("location:/manager/backgrounds/background-manager.php");
