<?php
    define("MENU_OPTION", "order");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    require_once($root_path . "/config/db.php");
    check_admin_signed_in(2);


    // Get all orders
    $bills = sql_query("
        SELECT *
        FROM bills;
    ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý hoá đơn</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
</head>
<body>
    <!-- Header menu -->
    <?php include_once("../templates/header.php"); ?>

    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once("../templates/menu.php"); ?>

        <!-- Main content -->
        <div class="page-content">
            <table id="content-table">
                <tr class="table-bar">
                    <td>Khách hàng</td>
                    <td>Người nhận</td>
                    <td>Địa chỉ nhận hàng</td>
                    <td>Điện thoại</td>
                    <td>Trạng thái</td>
                    <td>Thời điểm tạo</td>
                </tr>
                <?php
                    foreach ($bills as $bill) {
                        $customer_name = sql_query("
                            SELECT name
                            FROM customers
                            WHERE id = {$bill["id_customer"]};
                        ");
                        $customer_name = mysqli_fetch_array($customer_name)["name"];

                        $bill_state = sql_query("
                            SELECT state
                            FROM bill_states
                            WHERE id = {$bill["id_state"]};
                        ");
                        $bill_state = mysqli_fetch_array($bill_state)["state"];

                        ?>
                        <tr>
                            <td><?= $customer_name ?></td>
                            <td><?= $bill["receiver"] ?></td>
                            <td><?= $bill["address"] ?></td>
                            <td><?= $bill["phone"] ?></td>
                            <td>
                                <?php
                                    echo $bill_state;
                                    switch ($bill["id_state"]) {
                                        case 1:
                                            ?>  <br>
                                                <a href="/manager/orders/order-accept-process.php?id=<?= $bill["id"] ?>">Duyệt</a>
                                                <a href="/manager/orders/order-cancel-process.php?id=<?= $bill["id"] ?>">Hủy</a>
                                            <?php
                                            break;
                                        default:
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?= $bill["purchase_time"] ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>

    </div>
</body>
</html>
