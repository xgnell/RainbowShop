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
        }
        
        .table-header-container {
            display: grid;
            grid-template-columns: 170px auto;
            gap: 20px;
        }

        .table-header {
            text-align: center;
            border: 2px white solid;
            border-collapse: collapse;
        }
        .table-header tr {
            border: 2px white solid;
        }
        .table-header tr th {
            color: white;
            padding: 7px 0 7px 0;
            background-color: #363e7e;
            border: 2px white solid;
        }

        .disp-total {
            display: flex;
            justify-content: space-between;
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

    <?php
        $total_price = 0;
        if (customer_signed_in()) {
            if (empty($_SESSION["user"]["customer"]["cart"])) {
                // If there is no item in cart
                ?>
                <h1>Giỏ hàng hiện chưa có sản phẩm nào</h1>

                <!-- Sau se quay lai trang san pham chi tiet -->
                <a href="/public/home.php">Tiếp tục mua hàng</a>
                <?php

            } else {
                // Table Titles
                ?>
                <div class="panel table-header-container">
                    <div class="fake-div-picture"></div>
                    <div class="fake-div-info">
                        <table class="table-header">
                            <tr>
                                <!-- <th style="width: 205px; min-width: 205;">Ảnh sản phẩm</th> -->
                                <th style="width: 205px; min-width: 205;">Giá</th>
                                <th style="width: 155px; min-width: 155;">Loại</th>
                                <th style="width: 100px; min-width: 100;">Màu</th>
                                <th style="width: 125px; min-width: 125;">Kích thước</th>
                                <th style="width: 260px; min-width: 260;">Số lượng</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php

                // Cart has items
                foreach ($_SESSION["user"]["customer"]["cart"] as $item_id => $data) {
                    foreach ($data as $size_id => $amount) {
                        $size_name = sql_query("
                            SELECT size
                            FROM item_sizes
                            WHERE id = $size_id;
                        ");
                        $size_name = mysqli_fetch_array($size_name)["size"];
                        $total_price += spawn_cart_item($item_id, $size_name, $amount);
                    }
                }
                ?>
                <!-- Total panel -->
                <div class="panel">
                    <div class="disp-total">
                        <a href="#">Xoá toàn bộ giỏ hàng</a>
                        <span style="font-size: 20px; color: red;">Tổng: <?= $total_price ?> VNĐ</span>
                    </div>
                    <br>
                    <div style="display: flex; justify-content: flex-end;">
                        <a class="btn-buy" onclick="document.getElementById('get-info-form').style.visibility = 'visible'">Mua hàng</a>
                    </div>
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
