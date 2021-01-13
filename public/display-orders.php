<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "order");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
    require_once($root_path . "/public/templates/order-item.php");
    require_once($root_path . "/config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Show orders</title>
    <style>
        .panel {
            margin: 30px 5% 30px 5%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            width: 1210px;
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
            background-color: #dedede;
            padding: 5px 5px 5px 5px;
        }
    </style>
</head>
<body>
    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

    <div class="panel">
        <?php
            if (customer_signed_in()) {
                $number_orders = sql_query("
                    SELECT COUNT(id) as number_of_bills_of_current_customer
                    FROM bills
                    WHERE id_customer = {$_SESSION["user"]["customer"]["id"]};
                ");
                $number_orders = mysqli_fetch_array($number_orders)["number_of_bills_of_current_customer"];

                if ($number_orders == 0) {
                    ?>
                    <div class="notification">
                        <h1>Bạn chưa từng mua hàng</h1>
                        <a href="/public/home.php">Quay lại mua sắm</a>
                    </div>
                    <?php
                } else {
                    $orders = sql_query("
                        SELECT *
                        FROM bills
                        WHERE id_customer = {$_SESSION["user"]["customer"]["id"]};
                    ");

                    ?>
                    <table class="table-header">
                        <tr>
                            <th style="width: 220px; min-width: 220px;">Người nhận</th>
                            <th style="width: 270px; min-width: 270px;">Địa chỉ nhận hàng</th>
                            <th style="width: 160px; min-width: 160px;">Điện thoại</th>
                            <th style="width: 200px; min-width: 200px;">Thời gian đặt hàng</th>
                            <th style="width: 200px; min-width: 200px;">Tình trạng</th>
                            <th style="width: 105px; min-width: 105px"></th>
                        </tr>
                    </table>
                    <?php

                    foreach ($orders as $order) {
                        spawn_order_item($order["id"]);
                    }

                }
                /*
                    img - receive - address - phone - purchase-time - state
                    (state can use icon + popup)
                */
            } else {
                ?>
                <div class="notification">
                    <h1>Bạn phải đăng nhập để có thể xem</h1>
                    <a href="/public/home.php">Quay lại mua sắm</a>
                </div>
                <?php
            }
        ?>
    </div>

    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>