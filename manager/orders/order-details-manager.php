<?php
define("MENU_OPTION", "order");
$notification_title = "Quản lý hóa đơn";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);


require_once($root_path . "/config/default.php");
require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Lấy mã hóa đơn được gửi lên
$bill_id = $_GET["id"] ?? null;
if ($bill_id == null) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}

/* Kiểm tra tính hợp lệ của id */
if (!is_numeric($bill_id)) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}
$bill_id_db = sql_query("
    SELECT *
    FROM bills
    WHERE id = $bill_id;
");
if (mysqli_num_rows($bill_id_db) != 1) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}

$bill_state_id = sql_query("
    SELECT id_state
    FROM bills
    WHERE id = {$bill_id};
");
$bill_state_id = mysqli_fetch_array($bill_state_id)["id_state"];

$bill_state = sql_query("
    SELECT *
    FROM bill_states
    WHERE id = $bill_state_id;
");
$bill_state = mysqli_fetch_array($bill_state);

$bill_details = sql_query("
    SELECT *
    FROM bill_details
    WHERE id_bill = $bill_id;
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
    <script src="/manager/templates/js/confirm-action.js"></script>
    <style>
        :root {
            --min-width--display-item-name: 150px;
            --min-width--display-item-picture: 100px;
            --min-width--display-item-price: 120px;
            --min-width--display-item-type: 100px;
            --min-width--display-item-color: 70px;
            --min-width--display-size: 100px;
            --min-width--display-amount: 100px;
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
                    <td style="min-width: var(--min-width--display-item-name);">Tên</td>
                    <td style="min-width: var(--min-width--display-item-picture);">Ảnh</td>
                    <td style="min-width: var(--min-width--display-item-price);">Giá (VNĐ)</td>
                    <td style="min-width: var(--min-width--display-item-type);">Loại</td>
                    <td style="min-width: var(--min-width--display-item-color);">Màu</td>
                    <td style="min-width: var(--min-width--display-size);">Size</td>
                    <td style="min-width: var(--min-width--display-amount);">Số lượng</td>
                </tr>
                <?php
                    $total = 0;
                    foreach ($bill_details as $bill_detail) {
                        $total += $bill_detail["amount"] * $bill_detail["price"];

                        $item = sql_query("
                            SELECT *
                            FROM items
                            WHERE id = {$bill_detail["id_item"]};
                        ");
                        $item = mysqli_fetch_array($item);
                        
                        $item_type = sql_query("
                            SELECT type
                            FROM item_types
                            WHERE id = {$item["id_type"]};
                        ");
                        $item_type = mysqli_fetch_array($item_type)["type"];

                        $item_color = sql_query("
                            SELECT code
                            FROM item_colors
                            WHERE id = {$item["id_color"]};
                        ");
                        $item_color = mysqli_fetch_array($item_color)["code"];

                        $size_name = sql_query("
                            SELECT size
                            FROM item_sizes
                            WHERE id = {$bill_detail["id_size"]};
                        ");
                        $size_name = mysqli_fetch_array($size_name)["size"];

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item["name"]) ?></td>
                            <td>
                                <img style="height: 100px;" src="<?= ITEM_IMAGE_SOURCE_PATH . $item['picture'] ?>">
                            </td>
                            <td><?= number_format($bill_detail['price'], 0, ',', '.') ?> đ</td>
                            <td><?= $item_type ?></td>
                            <td>
                                <div style="
                                        display: inline-block;
                                        width: 20px; height: 20px;
                                        background-color: <?= $item_color ?>;
                                        <?php
                                            if ($item_color == 'white')
                                                echo 'border: 1px black solid;';
                                        ?>">
                                </div>
                            </td>
                            <td><?= $size_name ?></td>
                            <td><?= $bill_detail["amount"] ?></td>
                        </tr>
                        <?php
                    }
                ?>
                <tr class="table-bar-footer">
                    <td colspan="7" style="text-align: left;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            Tổng tiền: 
                            <span style="color: red;">
                                <?= number_format($total, 0, ',', '.') ?> VNĐ
                            </span>
                        </span>
                        <?php
                            switch ($bill_state_id) {
                                case 1:
                                    ?>
                                    <div style="display: flex; justify-content: space-around; width: 300px;">
                                        <a onclick="confirm_action('Bạn có chắc chắn muốn duyệt đơn hàng này ?', '/manager/orders/order-accept-process.php?id=<?= $bill_id ?>')">
                                            <svg style="position: relative; top: 2px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                            <span style="position: relative; top: -10px; color: <?= $bill_state["color"] ?>;">Duyệt</span>
                                        </a>
                                        <a onclick="confirm_action('Bạn có chắc chắn muốn hủy đơn hàng này ?', '/manager/orders/order-cancel-process.php?id=<?= $bill_id ?>')">
                                            <svg style="position: relative; top: 2px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>
                                            <span style="position: relative; top: -10px; color: <?= $bill_state["color"] ?>;">Hủy</span>
                                        </a>
                                    </div>
                                    <?php
                                    break;
                                case 2:
                                    ?>
                                    <div style="display: flex; justify-content: space-between; width: 120px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state["color"] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                        <span style="position: relative; top: 8px; color: <?= $bill_state["color"] ?>;"><?= $bill_state["state"] ?></span>
                                    </div>
                                    <?php
                                    break;
                                case 3:
                                    ?>
                                    <div style="display: flex; justify-content: space-between; width: 100px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $bill_state["color"] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>
                                        <span style="position: relative; top: 8px; color: <?= $bill_state["color"] ?>;"><?= $bill_state["state"] ?></span>
                                    </div>
                                    <?php
                                    break;
                                default:
                                    break;
                            }
                        ?>
                                
                    </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>
