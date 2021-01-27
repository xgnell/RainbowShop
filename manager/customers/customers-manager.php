<?php
    define("MENU_OPTION", "customer");
    $notification_title = "Quản lý khách hàng";
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/default.php");
    require_once($root_path . "/manager/templates/notification-page.php");


    $page = $_GET['page'] ?? 1;
    $item_per_page = DEFAULT_ITEM_PER_PAGE;

    // Kiểm tra tính hợp lệ của page
    if (!is_numeric($page)) {
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

    // Lấy tổng số sản phẩm
    $count = sql_query("
        SELECT COUNT(id) as number_of_items
        FROM customers;
    ");
    $count = mysqli_fetch_array($count)["number_of_items"];
    // Tính số trang
    $number_of_page = ceil($count / $item_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý khách hàng</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <script src="/manager/templates/js/confirm-action.js"></script>
    <?php require_once($root_path . "/config/db.php"); ?>
    <style>
        :root {
            --min-width--display-state-icon: 70px;
            --min-width--display-state: 100px;
        }
    </style>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <?php
                $customers = sql_query("
                    SELECT *
                    FROM customers;
                ");
            ?>

            <div class="scrollable">
            <table id="content-table">
                <tr class="table-bar-header">
                    <!-- <td hidden class="title">Id</td> -->
                    <td>Tên</td>
                    <td>Giới tính</td>
                    <td>Ngày tháng năm sinh</td>
                    <td>Điện thoại</td>
                    <td>Email</td>
                    <td>Địa chỉ</td>

                    <td colspan="2">Trạng thái</td>
                </tr>
                <?php foreach($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['name'] ?></td>
                        <td>
                            <?php
                                switch ($customer['gender']) {
                                    case 1:
                                        echo "Nữ";
                                        break;
                                    case 2:
                                        echo "Nam";
                                        break;
                                    case 3:
                                        echo "Giới tính khác";
                                        break;
                                    default:
                                        break;
                                }
                            ?>
                        </td>
                        <td><?= $customer['birth'] ?></td>
                        <td><?= $customer['phone'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= $customer['address'] ?></td>

                        <?php
                        $customer_state = sql_query("
                            SELECT state, color
                            FROM customer_states
                            WHERE id = {$customer['id_state']};
                        ");
                        $customer_state = mysqli_fetch_array($customer_state);
                        ?>
                        <td style="min-width: var(--min-width--display-state-icon); border-right: 0; text-align: right;">
                            <a class="btn-action" onclick="confirm_action('Bạn có chắc chắn muốn thực hiện hành động này ?', '/manager/customers/customer-toggle-lock.php?id=<?= $customer['id'] ?>')">
                            <?php
                                if ($customer["id_state"] == 1) {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $customer_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6h1.9c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 12H6V10h12v10z"/></svg>
                                    <?php
                                } else {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $customer_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                                    <?php
                                }
                            ?>
                            </a>
                        </td>
                        <td style="min-width: var(--min-width--display-state); border-left: 0;">
                            <span style="color: <?= $customer_state["color"] ?>">
                                <?= $customer_state["state"] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr class="table-bar-footer" style="bottom: 0;">
                    <td colspan="9">
                        <?php
                            for ($i = 1; $i <= $number_of_page; $i++ ) {
                                ?>
                                    <a class="page-number <?php if ($page == $i) echo "current-page"; ?>" href="/manager/customers/customers-manager.php?page=<?= $i ?>"><?= $i ?></a>
                                <?php
                            }
                            ?>
                    </td>
                </tr>
            </table>
            </div>
            <br>
            <!-- <a href="#">Add new</a> -->
        </div>

    </div>
</body>
</html>
