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
        .panel {
            margin: 30px 10% 30px 10%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            width: 1110px;
            min-height: 400px;
        }
        
        /* .table-header-container {
            display: grid;
            grid-template-columns: 170px auto;
            gap: 20px;
        } */

        .notification {
            width: 100%;
            padding: 10%;
            text-align: center;
        }
        .notification * {
            margin-bottom: 15px;
        }

        .table-header {
            text-align: center;
            border: 2px white solid;
            border-collapse: collapse;
            /* width: 100%; */
        }
        .table-header tr {
            border: 2px white solid;
        }
        .table-header tr th {
            /* color: white; */
            padding: 7px 0 7px 0;
            /* background-color: #363e7e; */
            /* background-color: #f7f7f7; */
            background-color: #dedede;
            border: 2px white solid;
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
            include_once($root_path . "/public/templates/get-info-before-order.php");
        }
    ?>

    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

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
                        <th style="width: 160px; min-width: 160px;">Ảnh</th>
                        <th style="width: 170px; min-width: 170px;">Tên</th>
                        <th style="width: 120px; min-width: 120px;">Giá</th>
                        <th style="width: 120px; min-width: 120px;">Loại</th>
                        <th style="width: 100px; min-width: 100px;">Màu</th>
                        <th style="width: 100px; min-width: 100px;">Size</th>
                        <th style="width: 200px; min-width: 200px;">Số lượng</th>
                        <th style="width: 90px; min-width: 90px;"></th>
                    </tr>
                </table>
                <?php

                // Cart has items
                foreach ($_SESSION["user"]["customer"]["cart"] as $item_id => $data) {
                    foreach ($data as $size_id => $amount) {
                        $total_price += spawn_cart_item($item_id, $size_id, $amount);
                    }
                }
                ?>
                <!-- Total panel -->
                <div class="disp-total">
                    <a class="btn-delete-all-cart" onclick="confirm_delete_all_cart()">Xoá toàn bộ giỏ hàng</a>
                    <span style="font-size: 20px; color: red; margin-right: 30px;">Tổng: <?= $total_price ?> VNĐ</span>
                </div>
                <br>
                <div style="display: flex; justify-content: flex-end;">
                    <a class="btn-buy" onclick="document.getElementById('get-info-form').style.visibility = 'visible'">Mua hàng</a>
                </div>
                <script defer>
                    function confirm_delete_all_cart() {
                        const yes = confirm("Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng ?");
                        if (yes) {
                            window.location.href = "/public/templates/delete-all-cart.php";
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

    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>
