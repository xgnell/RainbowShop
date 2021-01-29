<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    define("PAGE_NAME", "home");
    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/default.php");
    require_once($root_path . "/public/templates/ui/notification/notification-page.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_POST)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
    }

    $item_id = $_POST["id"] ?? null;
    $item_size_id = $_POST["size_id"] ?? null;
    $item_amount = $_POST["amount"] ?? null;


    // Sau sửa lại redirect tối ưu hơn
    $redirect = $_POST["redirect"] ?? null;
    if ($redirect == null || !is_numeric($redirect)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }


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
    $item = sql_query("
        SELECT *
        FROM items
        WHERE id = $item_id;
    ");
    if (mysqli_num_rows($item) != 1) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
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
    $item_size = sql_query("
        SELECT *
        FROM item_sizes
        WHERE id = $item_size_id;
    ");
    if (mysqli_num_rows($item_size) != 1) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }

    // Số lượng
    if ($item_amount == null || !is_numeric($item_amount)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }
    // Kiểm tra số lượng sản phẩm có hợp lệ hay không
    if ($item_amount > MAX_ITEM_CAN_PUT_INTO_CART) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Bạn chỉ được phép thêm tối đa $MAX_ITEM_CAN_PUT_INTO_CART sản phẩm vào giỏ hàng",
            "",
            "Quay lại"
        );
        exit();
    }
    $amount_db = sql_query("
        SELECT amount
        FROM item_details
        WHERE id_item = $item_id AND id_size = $item_size_id;
    ");
    $amount_db = mysqli_fetch_array($amount_db);
    if ($item_amount > $amount_db) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Hiện tại chúng tôi chỉ còn $amount_db sản phẩm trong kho",
            "Số lượng sản phẩm bạn đặt là $item_amount đã vượt quá số lượng trong kho",
            "Quay lại"
        );
        exit();
    }

    // Check if item in cart
    if (array_key_exists($item_size_id, $_SESSION["user"]["customer"]["cart"][$item_id])) {
        // Update
        $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] += $item_amount;
    } else {
        // Add new
        $_SESSION["user"]["customer"]["cart"][$item_id][$item_size_id] = $item_amount;
    }

    if ($redirect == 0) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Thêm sản phẩm vào giỏ hàng thành công",
            "",
            "Quay lại mua sắm",
            "/public/home.php"
        );
        // header("location:/public/home.php");
    } else {
        header("location:/public/display-cart.php");
    }
?>