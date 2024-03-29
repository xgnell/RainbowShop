<?php
$notification_title = "Quản lý câu hỏi";
$return_path = "/manager/questions/questions-manager.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");


$qna_id = $_GET["id"] ?? null;
if ($qna_id == null) {
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
if (!is_numeric($qna_id)) {
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
$qna_id_db = sql_query("
    SELECT *
    FROM qna
    WHERE id = {$qna_id};
");
if (mysqli_num_rows($qna_id_db) != 1) {
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



sql_cmd("
    DELETE FROM qna
    WHERE id = $qna_id;
");
display_notification_page(
    false,
    $notification_title,
    "Xóa thành công",
    "",
    "Quay lại",
    "/manager/questions/questions-manager.php"
);
