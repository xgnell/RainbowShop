<?php
/** Lưu trữ các thông tin mặc định
 * Mật khẩu admin mặc định
 * Độ dài mật khẩu tối thiểu
 * 
 * 
 * Theme cho trang web, dark mode hay light mode (Chỉ dành cho phần admin header với menu)
 * Số sản phẩm mặc định trên một trang
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "/notification/display-error-page.php");
if (basename($_SERVER['PHP_SELF']) == "default.php") {
    display_error_page(404, "Không tìm thấy trang");
    exit();
}

define('DEFAULT_ADMIN_PASSWORD', 'abcd1234');
define("ITEM_IMAGE_SOURCE_PATH", "/public/assets/items/");
<<<<<<< HEAD
define("BACKGROUND_IMAGE_SOURCE_PATH", "/public/assets/backgrounds/");
define("DEFAULT_ITEM_PER_PAGE", 10);
define("MAX_ITEM_CAN_PUT_INTO_CART", "50");
=======
define("DEFAULT_ITEM_PER_PAGE", 10);
define("MAX_ITEM_CAN_PUT_INTO_CART", "50");
>>>>>>> c77e7ab95a7e09441835069a863e1b9f614fffb3
