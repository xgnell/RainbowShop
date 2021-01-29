<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "order");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/public/templates/order/order-item.php");
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
            /* position: absolute; */
            display: inline-block;
            margin: 30px 5% 30px 5%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            width: 90%;
            /* min-width: 1210px; */
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
            /* border-radius: 5px; */
            text-align: center;
            width: 100%;
            /* border-top: 1px black solid; */
            /* border-bottom: 1px #ccc solid; */
            /* border: 1px #ccc solid; */
            border-collapse: collapse;
            /* padding: 5px 5px 5px 5px; */
        }
        .table-header tr:first-child {
            position: relative;
            box-shadow: 0px 5px 10px #ccc;

        }
        .table-header tr:nth-child(odd) {
            background-color: #f2f2f2;
            border: 5px white solid;
            /* padding: 10px 0 10px 0; */
            /* transition: 0.3s; */
        }
        .table-header tr:nth-child(odd):hover {
            background-color: #dedede;
        }
        .table-header tr:nth-child(even) {
            background-color: #f2f2f2;
            border: 5px white solid;
            /* padding: 10px 0 10px 0; */
            /* background-color: #ccc; */
            /* transition: 0.3s; */
        }
        .table-header tr:nth-child(even):hover {
            background-color: #dedede;
        }
        .table-header tr th {
            background-color: #363e7e;
            color: white;
            padding: 5px 10px 5px 10px;
            /* border-top: 1px #ccc solid; */
        }
        .table-header tr td {
            padding: 5px 10px 5px 10px;
            /* border-top: 1px #ccc solid; */
        }

        /* #delete_order {
            width: 500px;
            height: 300px;
            background-color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            z-index: 100%;
            box-shadow: 0px 5px 10px #ccc;
            display: none;
        } */

        .display-delete-order > div {
            font-size: bold;
            color: gray;
            margin-top: 100px;
            text-align: left;
        }
        .display-delete-order > div p:hover {
            color: red;
        }
    </style>
</head>
<body>
    <!-- <div style="background-color: blue; display: inline-block; width: 100%;"> -->
    <div>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/account/sign-in.php"); ?>

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
                            <th>Người nhận</th>
                            <th>Địa chỉ nhận hàng</th>
                            <th>Điện thoại</th>
                            <th>Thời gian đặt hàng</th>
                            <th colspan="2">Tình trạng</th>
                            <th>Chi tiết</th>
                            <!-- <th>Huỷ</th> -->
                        </tr>
                        <?php
                        foreach ($orders as $order) {
                            spawn_order_item($order["id"]);
                        }
                        ?>
                    </table>
                    
                    <div class="display-delete-order">
                        <div>
                            <p>Liên hệ lại với chúng tôi nếu bạn có nhu cầu hủy đơn hàng</p>
                            <p>Lưu ý: chúng tôi chỉ cho phép hủy đơn hàng trước 24h kể từ lúc đặt hàng</p>
                        </div>
                    </div>
                    <?php

                }
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

    <!-- <div id="delete_order" style="padding: 20px; align-items: center;">
        <div style="padding-bottom: 30px;">
            <h1 style="text-align: center;">Thông báo</h1>
            <button style="position: absolute; top:10px; right:10px;" onclick="show_delete_info()">X</button>
        </div>
        <div style="text-align: center; font-size:20px;">
            Bạn phải liên hệ trực tiếp cho chúng tôi với số máy được lưu ở phía dưới
            hoặc đến trực tiếp trụ sở công ty
            <br>
            <br>
            <br>
            <br>
            Xin chân thành cảm ơn!
        </div>
    </div> -->

    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
    <!-- </div> -->
</body>
</html>