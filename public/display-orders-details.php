<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "cart");
    require_once($root_path . "/public/templates/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/order-detail-item.php");

    $bill_id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/templates/css/all.css">
    <title>Lịch sử mua hàng chi tiết</title>
    <style>
        .panel {
            margin: 30px 12% 30px 12%;
            padding: 15px 15px 15px 15px;
            background-color: white;
            border-radius: 7px;
            box-shadow: 1px 1px 5px #ccc;
            width: 1030px;
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
    </style>
</head>
<body>
    <?php include_once($root_path . "/public/templates/header.php"); ?>
    <?php include_once($root_path . "/public/templates/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/sign-in.php"); ?>

    <div class="panel">
    <?php
        if (customer_signed_in()) {
            $bill_data_details = sql_query("
                SELECT *
                FROM bill_details
                WHERE id_bill = $bill_id;
            ");

            ?>
            <table class="table-header">
                <tr>
                    <th style="width: 160px; min-width: 160px;">Ảnh</th>
                    <th style="width: 170px; min-width: 170px;">Tên</th>
                    <th style="width: 120px; min-width: 120px;">Giá</th>
                    <th style="width: 120px; min-width: 120px;">Loại</th>
                    <th style="width: 100px; min-width: 100px;">Màu</th>
                    <th style="width: 100px; min-width: 100px;">Size</th>
                    <th style="width: 215px; min-width: 215px;">Số lượng</th>
                </tr>
            </table>
            <?php

            foreach ($bill_data_details as $bill_data) {
                spawn_order_detail_item(
                    $bill_data["id_item"],
                    $bill_data["id_size"],
                    $bill_data["amount"],
                    $bill_data["price"]
                );
            }
        } else {
            ?>
            <div class="notification">
                <h1>Đăng nhập để xem</h1>
                <a href="/public/home.php">Quay lại mua sắm</a>
            </div>
            <?php
        }
    ?>
    </div>

    <?php include_once($root_path . "/public/templates/footer.php"); ?>
</body>
</html>
