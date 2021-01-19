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
    <style>
        :root {
            --min-width--display-customer-name: 130px;
            --min-width--display-receiver: 130px;
            --min-width--display-address: 200px;
            --min-width--display-phone: 130px;

            --min-width--display-state-icon: 70px;
            --min-width--display-state: 100px;

            --min-width--display-purchase-time: 130px;
            --min-width--display-detail-btn: 100px;
        }
        #display-state a {
            display: inline-block;
            margin: 5px 0px 5px 0px;
            padding: 5px 5px 1px 5px;
            color: black
        }
        #display-state a:hover {
            background-color: #ccc;
        }
    </style>
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
                <tr class="table-bar-header">
                    <td style="min-width: var(--min-width--display-customer-name);">Khách hàng</td>
                    <td style="min-width: var(--min-width--display-receiver);">Người nhận</td>
                    <td style="min-width: var(--min-width--display-address);">Địa chỉ nhận hàng</td>
                    <td style="min-width: var(--min-width--display-phone);">Điện thoại</td>
                    <td colspan="2">Trạng thái</td>
                    <td style="min-width: var(--min-width--display-purchase-time);">Thời điểm tạo</td>
                    <td style="min-width: var(--min-width--display-detail-btn);">Chi tiết</td>
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
                            SELECT state, color
                            FROM bill_states
                            WHERE id = {$bill["id_state"]};
                        ");
                        $bill_state = mysqli_fetch_array($bill_state);

                        ?>

                        <!-- Display UI -->
                        <tr>
                            <td><?= $customer_name ?></td>
                            <td><?= $bill["receiver"] ?></td>
                            <td><?= $bill["address"] ?></td>
                            <td><?= $bill["phone"] ?></td>
                            
                            
                            <!-- Display state -->
                            <td id="display-state-icon" style="min-width: var(--min-width--display-state-icon); border-right: 0; text-align: right;">
                                <?php
                                    switch ($bill["id_state"]) {
                                        case 1:
                                            ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="<?= $bill_state["color"] ?>" width="36px" height="36px"><g><rect fill="none" height="24" width="24"/></g><g><path d="M18,22l-0.01-6L14,12l3.99-4.01L18,2H6v6l4,4l-4,3.99V22H18z M8,7.5V4h8v3.5l-4,4L8,7.5z"/></g></svg>
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state["color"] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                            <?php
                                            break;
                                        case 3:
                                            ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state["color"] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>
                                            <?php
                                            break;
                                        default:
                                            break;
                                    }
                                ?>
                            </td>
                            <td id="display-state" style="min-width: var(--min-width--display-state); border-left: 0; text-align: left;">
                                <?php
                                    switch ($bill["id_state"]) {
                                        case 1:
                                            ?>
                                            <span style="color: <?= $bill_state["color"] ?>;"><?= $bill_state["state"] ?></span>
                    
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <span style="color: <?= $bill_state["color"] ?>;"><?= $bill_state["state"] ?></span>
                                            <?php
                                            break;
                                        case 3:
                                            ?>
                                            <span style="color: <?= $bill_state["color"] ?>;"><?= $bill_state["state"] ?></span>
                                            <?php
                                            break;
                                        default:
                                            break;
                                    }
                                ?>
                            </td>

                            <td><?= $bill["purchase_time"] ?></td>
                            <td>
                                <!-- View detail orders -->
                                <a href="/manager/orders/order-details-manager.php?id=<?= $bill["id"] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z"/></svg>
                                </a>
                            </td>

                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>

    </div>
</body>
</html>
