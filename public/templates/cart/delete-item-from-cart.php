<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/check-customer-signed-in.php");
require_once($root_path . "/public/templates/ui/notification/notification-page.php");

if (customer_signed_in()) {
    $item_id = $_GET["id"] ?? null;
    $item_size_id = $_GET["size_id"] ?? null;
    ///// Have to check if sesssion customer exist

    // Validate dữ liệu
    // Mã sản phẩm
    if ($item_id == null || !is_numeric($item_id)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }
    if (!array_key_exists($item_id, $_SESSION["user"]["customer"]["cart"])) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Sản phẩm không tồn tại trong giỏ hàng",
            "",
            "Quay lại"
        );
        exit();
    }


    // Kích thước
    if ($item_size_id == null || !is_numeric($item_size_id)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }
    if (!array_key_exists($item_size_id, $_SESSION["user"]["customer"]["cart"][$item_id])) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Sản phẩm không tồn tại trong giỏ hàng",
            "",
            "Quay lại"
        );
        exit();
    }

    // Kiem tra neu la san pham cuoi cung trong gio hang => Xoa gio hang
    if (count($_SESSION["user"]["customer"]["cart"]) <= 1) {
        unset($_SESSION["user"]["customer"]["cart"]);
    } else {
        unset($_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id]);
    }

    header("location:/public/display-cart.php");
} else {
    display_front_notification_page(
        false,
        "Rainbow Kitty",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
    );
}