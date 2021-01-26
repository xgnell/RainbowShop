<?php
/** Validate
 * Kiểm tra id có được gửi lên không
 * Kiểm tra tính hợp lệ của id (Xem có đúng là số hay không, có nằm trong giới hạn hay ko)
 * Kiểm tra id admin có tồn tại trong db hay ko
 * Kiểm tra không cho phép xóa bản thân
 * Kiểm tra không cho phép admin cấp độ thấp xóa admin cấp độ cao
 */

$notification_title = "Quản lý admin";
$root_path = $_SERVER["DOCUMENT_ROOT"];
// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(1);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Lấy id của admin từ url
$admin_id = $_GET["id"] ?? null;

if ($admin_id == null) {
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




/* Kiểm tra tính hợp lệ của id */
$id_regex = "/^[0-9]+$/";
if (!preg_match($id_regex, $admin_id) ||
    (preg_match($id_regex, $admin_id) && $admin_id < 1)
) {
    display_notification_page(
        false,
        $notification_title,
        "Admin không tồn tại",
        "",
        "/manager/admins/admins-manager.php"
    );
    exit();
}

/* Kiểm tra id admin có tồn tại trong csdl hay không */
$admin = sql_query("
    SELECT *
    FROM admins
    WHERE id = $admin_id;
");
if (mysqli_num_rows($admin) != 1) {
    display_notification_page(
        false,
        $notification_title,
        "Admin không tồn tại",
        "",
        "/manager/admins/admins-manager.php"
    );
    exit();
}

/* Không cho phép tự delete mình */
$current_admin_id = $_SESSION["user"]["admin"]["id"];
if ($current_admin_id == $admin_id) {
    display_notification_page(
        false,
        $notification_title,
        "Bạn không thể xóa chính mình",
        "",
        "/manager/admins/admins-manager.php"
    );
    exit();
}

/* Không cho phép admin delete super admin */
$admin = mysqli_fetch_array($admin);
$admin_rank = sql_query("
    SELECT level
    FROM admin_ranks
    WHERE id = {$admin["id_rank"]};
");
$admin_rank = mysqli_fetch_array($admin_rank)["level"];
$current_admin_rank = $_SESSION["user"]["admin"]["rank"]["level"];
if ($current_admin_rank >= $admin_rank) {
    display_notification_page(
        false,
        $notification_title,
        "Bạn không có đủ quyền hạn để xóa admin này",
        "",
        "/manager/admins/admins-manager.php"
    );
    exit();
}


/******************************* Cho phép xóa admin ***************************************/
sql_cmd("
    DELETE FROM admins
    WHERE id = $admin_id;
");
display_notification_page(
    true,
    $notification_title,
    "Thực hiện thành công",
    "",
    "/manager/admins/admins-manager.php"
);