<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
require_once($root_path . "/config/db.php");

if (customer_signed_in()) {
    $customer_id = $_POST["id_customer"];   
    $receiver = $_POST["receiver"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    $cart = $_SESSION["user"]["customer"]["cart"];

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

    ?>
        <h3>Đặt hàng thành công</h3>
        <a href="/public/home.php">Quay lại mua sắm</a>        
    <?php
} else {
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}
