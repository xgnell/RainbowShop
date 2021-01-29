<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");
require_once($root_path . "/public/templates/ui/notification/notification-page.php");

if (customer_signed_in()) {
    if (empty($_POST)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "404",
            "Không tìm thấy trang",
            "Quay lại"
        );
        exit();
    }

    $customer_id = $_SESSION["user"]["customer"]["id"];   
    $receiver = htmlspecialchars($_POST["receiver"] ?? null);
    $phone = htmlspecialchars($_POST["phone"] ?? null);
    $address = htmlspecialchars($_POST["address"] ?? null);
    
    $cart = $_SESSION["user"]["customer"]["cart"];


    // Validate dữ liệu
    $return_path = "/public/display-cart.php";
    // Tên người nhận
    function remove_ascent ($name) {
        if ($name === null) return $name;
        $name = preg_replace("/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ầ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/", "a", $name);
        $name = preg_replace("/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/", "e", $name);
        $name = preg_replace("/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ/", "i", $name);
        $name = preg_replace("/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/", "o", $name);
        $name = preg_replace("/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/", "u", $name);
        $name = preg_replace("/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/", "y", $name);
        $name = preg_replace("/đ|Đ/", "d", $name);
        $name = strtolower($name);
        return $name;
    }
    $receiver_regex = "/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/";
    $receiver = htmlspecialchars(remove_ascent($receiver));
    if ($receiver == null || !preg_match($receiver_regex, $receiver)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Tên người nhận không hợp lệ",
            "",
            "Thử lại",
            $return_path
        );
        exit();
    }


    $phone_regex = "/^0[0-9]{9,9}$/";
    if ($phone == null || !preg_match($phone_regex, $phone)) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Số điện thoại không hợp lệ",
            "",
            "Thử lại",
            $return_path
        );
        exit();
    }

    if ($address == null) {
        display_front_notification_page(
            false,
            "Rainbow Kitty",
            "Địa chỉ không hợp lệ",
            "",
            "Thử lại",
            $return_path
        );
        exit();
    }




    // Insert into Bills
    $current_datetime = date("Y-m-d H-i-s");
    sql_cmd("
        INSERT INTO bills (
            id_customer,
            receiver,
            address,
            phone,
            id_state,
            purchase_time
        )
        VALUES (
            $customer_id,
            '$receiver',
            '$address',
            '$phone',
            1,
            '$current_datetime'
        );
    ");
    // Get bill id
    $bill_id = sql_query("
        SELECT MAX(id) as max_id
        FROM bills;
    ");
    $bill_id = mysqli_fetch_array($bill_id)["max_id"];



    // Insert items from cart to bill details
    foreach ($cart as $item_id => $data) {
        // Get item price
        $item_price = sql_query("
            SELECT price
            FROM items
            WHERE id = $item_id;
        ");
        $item_price = mysqli_fetch_array($item_price)["price"];

        // Insert data
        foreach ($data as $size_id => $amount) {
            // Update amount from items details
            sql_cmd("
                UPDATE item_details
                SET amount = amount - $amount
                WHERE id_item = $item_id AND id_size = $size_id;
            ");
            
            // Insert into bill details
            sql_cmd("
                INSERT INTO bill_details (
                    id_bill,
                    id_item,
                    id_size,
                    amount,
                    price
                )
                VALUES (
                    $bill_id,
                    $item_id,
                    $size_id,
                    $amount,
                    $item_price
                );
            ");
        }
    }

    // Delete cart
    unset($_SESSION["user"]["customer"]["cart"]);

    display_front_notification_page(
        true,
        "Rainbow Kitty",
        "Đặt hàng thành công",
        "",
        "Quay lại mua sắm",
        "/public/home.php"
    );
} else {
    display_front_notification_page(
        false,
        "Rainbow Kitty",
        "404",
        "Không tìm thấy trang",
        "Quay lại"
    );
}
