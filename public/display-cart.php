<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "cart");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/cart/cart-item.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Show cart</title>
    <style>
        .panel {
            margin: 30px 10% 30px 10%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            /* width: 1110px; */
            min-height: 400px;
        }

        .notification {
            width: 100%;
            padding: 10%;
            text-align: center;
        }
        .notification * {
            margin-bottom: 15px;
        }

        .table-header {
            width: 100%;
            text-align: center;
            border: 2px white solid;
            border-collapse: collapse;
            /* width: 100%; */
        }
        .table-header tr {
            border: 3px white solid;
        }
        .table-header tr th {
            padding: 7px 0 7px 0;
            background-color: #363e7e;
            color: white;
        }
        .table-header tr {
            background-color: #f2f2f2;
        }
        .table-header tr:hover {
            background-color: #dedede;
        }
        .table-header tr:first-child {
            position: relative;
            box-shadow: 0px 5px 10px #ccc;

        }
        .table-header .btn-amount {
            display: inline-block;
            width: 30px;
            font-size: 22px;
            padding: 3px 4px 3px 4px;
            background-color: #f7f7f7;
            cursor: pointer;
        }
        .table-header .btn-amount:hover {
            background-color: rgb(208, 209, 214);
        }

        .table-header .input-amount{
            width: 70px;
            margin: 0;
            text-align: center;
            padding: 5px 5px 5px 5px;
            border-radius: 0px;
            border: 0px;
            border-left: 1px gray solid;
            border-right: 1px gray solid;
            background-color: #f7f7f7;
            color: black;
        }

        .table-header .popup-box {
            visibility: hidden;
            position: absolute;
            right: 3em;
            background-color: white;
            border: 1px #ccc solid;
            padding: 10px 10px 10px 10px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 20%);
        }

        .table-header .disp-color {
            display: inline-block;
            width: 20px;
            height: 20px;
        }

        .disp-total {
            display: flex;
            justify-content: space-between;
        }

        .btn-delete-all-cart {
            color: gray;
            cursor: pointer;
        }
        .btn-delete-all-cart:hover {
            color: red;
        }

        .btn-buy {
            font-size: 30px;
            margin-right: 25px;
            margin-bottom: 15px;
            padding: 10px 20px 10px 20px;
            color: white;
            cursor: pointer;
            background-color: red;
            border-radius: 5px;
        }
        .btn-buy:hover {
            color: yellow;
        }
    </style>
</head>
<body>
    <?php
        if (customer_signed_in()) {
            include_once($root_path . "/public/templates/order/get-info-before-order.php");
        }
    ?>

    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/account/sign-in.php"); ?>

    <div class="panel">
    <?php
        $total_price = 0;
        if (customer_signed_in()) {
            if (empty($_SESSION["user"]["customer"]["cart"])) {
                // If there is no item in cart
                ?>
                <div class="notification">
                    <h1>Giỏ hàng hiện chưa có sản phẩm nào</h1>
                    <a href="/public/home.php">Quay lại mua hàng</a>
                </div>
                <?php

            } else {
                // Table Titles
                ?>
                <table class="table-header">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá (VNĐ)</th>
                        <th>Loại</th>
                        <th>Màu</th>
                        <th>Size</th>
                        <th style="width: 100px; min-width: 100px;">Số lượng</th>
                        <th style="min-width: 50px;">Xóa</th>
                    </tr>
                    <?php
                    // Cart has items
                    foreach ($_SESSION["user"]["customer"]["cart"] as $item_id => $data) {
                        foreach ($data as $size_id => $amount) {
                            $total_price += spawn_cart_item($item_id, $size_id, $amount);
                        }
                    }
                    ?>
                </table>
                
                <!-- Total panel -->
                <div class="disp-total" style="margin-top: 100px;">
                    <a class="btn-delete-all-cart" onclick="confirm_delete_all_cart()">Xoá toàn bộ giỏ hàng</a>
                    <span style="font-size: 20px; color: red; margin-right: 30px;">Tổng: <?= number_format($total_price, 0, ',', '.') ?> VNĐ</span>
                </div>
                <br>
                <div style="display: flex; justify-content: flex-end;">
                    <a class="btn-buy" onclick="document.getElementById('get-info-form').style.visibility = 'visible'">Mua hàng</a>
                </div>
                <script defer>
                    function confirm_delete_all_cart() {
                        const yes = confirm("Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng ?");
                        if (yes) {
                            window.location.href = "/public/templates/cart/delete-all-cart.php";
                        }
                    }
                </script>
                <?php
            }
        } else {
            ?>
            <div class="notification">
                <h1>Đăng nhập để thêm hàng vào giỏ</h1>
                <a href="/public/home.php">Quay lại mua sắm</a>
            </div>
            <?php
        }
    ?>
    </div>

    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>
</html>
