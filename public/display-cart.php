<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "cart");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    // include_once($root_path . "/public/templates/item.php");
    include_once($root_path . "/public/templates/cart-item.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Show cart</title>
    <style>
        .disp-total {
            margin: 30px 10% 30px 10%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
        }
    </style>
</head>
<body>
    <?php
        if (customer_signed_in()) {
            include_once($root_path . "/public/templates/get-info-before-order.php");
        }
    ?>

    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

    <?php
        $total_price = 0;
        if (customer_signed_in()) {
            if (empty($_SESSION["user"]["customer"]["cart"])) {
                // If there is no item in cart
                ?>
                <h1>Giỏ hàng hiện chưa có sản phẩm nào</h1>

                <!-- Sau se quay lai trang san pham chi tiet -->
                <a href="#">Tiếp tục mua hàng</a>
                <?php

            } else {
                // Cart has items
                foreach ($_SESSION["user"]["customer"]["cart"] as $item_id => $data) {
                    foreach ($data as $size => $amount)
                    $total_price += spawn_cart_item($item_id, $size, $amount);
                }
                ?>
                <!-- Total panel -->
                <div class="disp-total">
                    Total price: <?= $total_price ?>

                    <a onclick="document.getElementById('get-info-form').style.visibility = 'visible'">Mua hàng</a>
                </div>
                <?php
            }
        } else {
            ?>
            <h1>Đăng nhập để thêm hàng vào giỏ</h1>
            <!-- <a onclick="window.history.back()">Back</a> -->
            <?php
        }
    ?>


    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>