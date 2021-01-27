<?php
define("MENU_OPTION", "customer");
$notification_title = "Quản lý khách hàng";
$return_path = "/manager/customers/customers-manager.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Lấy id của khách hàng được gửi lên
$customer_id = $_GET["id"] ?? null;
if ($customer_id == null) {
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
if (!is_numeric($customer_id)) {
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
$customer_id_db = sql_query("
    SELECT *
    FROM customers
    WHERE id = {$customer_id};
");
if (mysqli_num_rows($customer_id_db) != 1) {
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
$customer_state_id = sql_query("
    SELECT id_state
    FROM customers
    WHERE id = $customer_id;
");
$customer_state_id = mysqli_fetch_array($customer_state_id)["id_state"];

if ($customer_state_id == 1) {
    $customer_state_id = 2;
} else {
    $customer_state_id = 1;
}

// Update trạng thái của khách hàng
sql_cmd("
    UPDATE customers
    SET
        id_state = $customer_state_id
    WHERE
        id = $customer_id;
");
header("location:$return_path");
