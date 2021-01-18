<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    define("PAGE_NAME", "cart");
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    require_once($root_path . "/config/db.php");
    include_once($root_path . "/public/templates/order/order-detail-item.php");

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
            min-height: 400px;
        }

        /* Bảng thông báo */
        .notification {
            width: 100%;
            padding: 10%;
            text-align: center;
        }
        .notification * {
            margin-bottom: 15px;
        }


        /* Bảng hiển thị các sản phẩm của hóa đơn */
        .table-header {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }
        .table-header tr {
            border: 15px white solid;
        }

        .table-header tr:first-child {
            position: relative;
            border: 20px white solid;
            margin-bottom: 15px;
            /* box-shadow: 0px 3px 5px #ccc; */

        }

        /********************* Chia hàng chẵn lẻ ****************************/
        .table-header tr:nth-child(odd) {
            background-color: #f2f2f2;
            border-bottom: 20px white solid;
        }
        .table-header tr:nth-child(odd):hover {
            background-color: #dedede;
        }

        .table-header tr:nth-child(even) {
            background-color: #f2f2f2;
            border-bottom: 20px white solid;
            /* background-color: #ccc; */
        }
        .table-header tr:nth-child(even):hover {
            background-color: #dedede;
            /* background-color: #ccc; */
            /* transition: 0.3s; */
        }

        .table-header .display-total {
            text-align: left;
        }
        /****************************************************/


        /********************** Các cột ************************/
        .table-header tr th {
            background-color: #363e7e;
            color: white;
            padding: 5px 10px 5px 10px;
        }
        .table-header tr td {
            padding: 5px 10px 5px 10px;
        }
        /***************************************************/

    </style>
</head>
<body>
    <?php include_once($root_path . "/public/templates/ui/header.php"); ?>
    <?php include_once($root_path . "/public/templates/ui/menu.php"); ?>
    <?php include_once($root_path . "/public/templates/account/sign-in.php"); ?>

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
                    <!-- <th style="width: 160px; min-width: 160px;">Ảnh</th>
                    <th style="width: 170px; min-width: 170px;">Tên</th>
                    <th style="width: 120px; min-width: 120px;">Giá</th>
                    <th style="width: 120px; min-width: 120px;">Loại</th>
                    <th style="width: 100px; min-width: 100px;">Màu</th>
                    <th style="width: 100px; min-width: 100px;">Size</th>
                    <th style="width: 215px; min-width: 215px;">Số lượng</th> -->
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Loại</th>
                    <th>Màu</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                </tr>

                <?php
                $total = 0;
                foreach ($bill_data_details as $bill_data) {
                    $total += $bill_data["amount"] * $bill_data["price"];
                    spawn_order_detail_item(
                        $bill_data["id_item"],
                        $bill_data["id_size"],
                        $bill_data["amount"],
                        $bill_data["price"]
                    );
                }
                ?>

                <tr class="display-total">
                    <th colspan="7">
                        Tổng tiền: <?= $total ?>
                    </th>
                </tr>
            </table>
            <?php
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

    <?php include_once($root_path . "/public/templates/ui/footer.php"); ?>
</body>
</html>
