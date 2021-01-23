<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/notification-page.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function check_admin_signed_in(int $level) {
    // if (!is_admin_signed_in()) {
    //     display_notification_page(
    //         false,
    //         "Quản lý admin",
    //         "Không thể truy cập",
    //         "Bạn không có quyền truy cập trang này"
    //     );
    //     exit();
    // } else if (!is_admin_rank($level)) {
    //     display_notification_page(
    //         false,
    //         "Quản lý admin",
    //         "Không thể truy cập",
    //         "Bạn không đủ quyền hạn để truy cập trang này"
    //     );
    //     exit();
    // }
    if (!is_admin_signed_in() || !is_admin_rank($level)) {
        display_notification_page(
            false,
            "Quản lý admin",
            "Không thể truy cập",
            "Không tìm thấy trang"
        );
        exit();
    }
}
function is_admin_signed_in(): bool {
    if (isset($_SESSION["user"]) && $_SESSION["user"]["type"] == "admin") {
        return true;
    }
    return false;
}
function is_admin_rank(int $level): bool {
    if (isset($_SESSION["user"]["admin"]["rank"]) && $_SESSION["user"]["admin"]["rank"]["level"] <= $level) {
        return true;
    }
    return false;
}