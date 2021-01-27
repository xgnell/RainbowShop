<?php
/** Validate
 * Kiểm tra tính hợp lệ của id
 * Kiểm tra trạng thái đơn hàng hiện tại trước khi thực hiện hành động
 */
$notification_title = "Quản lý hóa đơn";
$root_path = $_SERVER["DOCUMENT_ROOT"];
    
// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");


$bill_id = $_GET["id"] ?? null;
if ($bill_id == null) {
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
if (!is_numeric($bill_id)) {
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
$bill_id_db = sql_query("
    SELECT *
    FROM customers
    WHERE id = {$bill_id};
");
if (mysqli_num_rows($bill_id_db) != 1) {
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

// Kiểm tra trạng thái đơn hàng hiện tại
$bill_state_id = sql_query("
    SELECT id_state
    FROM bills
    WHERE id = $bill_id;
");
$bill_state_id = mysqli_fetch_array($bill_state_id)["id_state"];
if ($bill_state_id != 1) { // Đơn hàng đã duyệt hoặc hủy
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


$update_time = date("Y-m-d H-i-s");
sql_cmd("
    UPDATE bills
    SET
        id_state = 2,
        id_admin = {$_SESSION["user"]["admin"]["id"]},
        updated_at = $update_time
    WHERE id = $bill_id;
");

header("location:/manager/orders/orders-manager.php");