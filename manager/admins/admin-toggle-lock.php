<?php
define("MENU_OPTION", "admin");
$notification_title = "Quản lý admin";
$return_path = "/manager/admins/admins-manager.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(1);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Lấy id của admin được gửi lên
$admin_id = $_GET["id"] ?? null;
if ($admin_id == null) {
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

/* Kiểm tra tính hợp lệ của id */
if (!is_numeric($admin_id)) {
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
$admin_id_db = sql_query("
    SELECT *
    FROM admins
    WHERE id = {$admin_id};
");
if (mysqli_num_rows($admin_id_db) != 1) {
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

// Kiểm tra nếu là super admin thì không được khóa
$admin_rank_id = sql_query("
    SELECT id_rank
    FROM admins
    WHERE id = {$admin_id};
");
$admin_rank_id = mysqli_fetch_array($admin_rank_id)["id_rank"];
$admin_rank_level = sql_query("
    SELECT level
    FROM admin_ranks
    WHERE id = {$admin_rank_id};
");
$admin_rank_level = mysqli_fetch_array($admin_rank_level)["level"];
if ($admin_rank_level == 1) {
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



// Chuyển đổi trạng thái của khách hàng
$admin_state_id = sql_query("
    SELECT id_state
    FROM admins
    WHERE id = $admin_id;
");
$admin_state_id = mysqli_fetch_array($admin_state_id)["id_state"];

if ($admin_state_id == 1) {
    $admin_state_id = 2;
} else {
    $admin_state_id = 1;
}

// Update trạng thái của khách hàng
sql_cmd("
    UPDATE admins
    SET
        id_state = $admin_state_id
    WHERE
        id = $admin_id;
");
header("location:$return_path");
