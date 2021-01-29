<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
// require_once($root_path . "/manager/templates/check-admin-signed-in.php");
require_once($root_path . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "pagination-header.php") {
    display_notification_page(
        false,
        "Quản lý admin",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước
    );
    exit();
}


$page = $_GET['page'] ?? 1;
$item_per_page = DEFAULT_ITEM_PER_PAGE;

// Kiểm tra tính hợp lệ của page
if (!is_numeric($page)) {
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

// Lấy tổng số sản phẩm
$count = sql_query("
    SELECT COUNT(id) as number_of_items
    FROM $pagination_table;
");
$count = mysqli_fetch_array($count)["number_of_items"];
// Tính số trang
$number_of_page = ceil($count / $item_per_page);