<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/manager/templates/notification-page.php");
if (basename($_SERVER['PHP_SELF']) == "check-admin-signed-in.php") {
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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function check_admin_signed_in(int $level) {
    if (!is_admin_signed_in() || !is_admin_rank_valid($level)) {
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
}

function check_exact_admin_signed_in($admin_id) {
    if ($_SESSION["user"]["admin"]["id"] != $admin_id) {
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
}



function is_admin_signed_in(): bool {
    if (isset($_SESSION["user"]) && $_SESSION["user"]["type"] == "admin") {
        return true;
    }
    return false;
}
function is_admin_rank_valid(int $level): bool {
    if (isset($_SESSION["user"]["admin"]["rank"]) && $_SESSION["user"]["admin"]["rank"]["level"] <= $level) {
        return true;
    }
    return false;
}