<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
require_once($root_path . "/public/templates/ui/notification/notification-page.php");

if (customer_signed_in()) {
    ///// Have to check if sesssion customer exist
    unset($_SESSION["user"]["customer"]["cart"]);
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