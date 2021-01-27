<?php
    define("MENU_OPTION", "admin");
    $notification_title = "Quản lý admin";
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/manager/templates/notification-page.php");
    require_once($root_path . "/config/default.php");


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
        FROM admins;
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
    
    <title>Quản lý admin</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <script src="/manager/templates/js/confirm-action.js"></script>
</head>
<body>
    <!-- Header menu -->
    <div class="page-header">
        <?php include_once($root_path . "/manager/templates/header.php"); ?>
    </div>
    <div class="page-body">
        <!-- Slide menu -->
        <div class="page-menu">
            <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        </div>
        <!-- Main content -->
        <div class="page-content">
            <?php
                $admins = sql_query("
                    SELECT *
                    FROM admins;
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
                    <td>Cấp độ</td>

                    <td colspan="2">Trạng thái</td>
                    <td>Sửa</td>
                </tr>
                <?php foreach($admins as $admin): ?>
                    <?php
                        // Get admin rank
                        $admin_rank = sql_query("
                            SELECT name, level
                            FROM admin_ranks
                            WHERE id = {$admin["id_rank"]};
                        ");
                        $admin_rank = mysqli_fetch_array($admin_rank);
                    ?>
                    <tr>
                        <td><?= $admin['name'] ?></td>
                        <td>
                            <?php
                                switch ($admin['gender']) {
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
                        <td><?= $admin['birth'] ?></td>
                        <td><?= $admin['phone'] ?></td>
                        <td><?= $admin['email'] ?></td>
                        <td><?= $admin_rank['name'] ?></td>


                        <?php
                        $admin_state = sql_query("
                            SELECT state, color
                            FROM admin_states
                            WHERE id = {$admin['id_state']};
                        ");
                        $admin_state = mysqli_fetch_array($admin_state);
                        ?>
                        <?php if ($admin_rank["level"] != 1): ?>
                        <td style="min-width: var(--min-width--display-state-icon); border-right: 0; text-align: right;">
                            <a class="btn-action" onclick="confirm_action('Bạn có chắc chắn muốn thực hiện hành động này ?', '/manager/admins/admin-toggle-lock.php?id=<?= $admin['id'] ?>')">
                            <?php
                                if ($admin["id_state"] == 1) {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $admin_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6h1.9c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 12H6V10h12v10z"/></svg>
                                    <?php
                                } else {
                                    ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="<?= $admin_state['color'] ?>" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                                    <?php
                                }
                            ?>
                            </a>
                        </td>
                        <td style="min-width: var(--min-width--display-state); border-left: 0;">
                            <span style="color: <?= $admin_state["color"] ?>">
                                <?= $admin_state["state"] ?>
                            </span>
                        </td>
                        <?php else: ?>
                            <td style="min-width: var(--min-width--display-state-icon); border-right: 0; text-align: right;"></td>
                            <td style="min-width: var(--min-width--display-state); border-left: 0;">
                                <span style="color: <?= $admin_state["color"] ?>">
                                    <?= $admin_state["state"] ?>
                                </span>
                            </td>
                        <?php endif ?>

                        <td>
                            <a class="btn-action" href="/manager/admins/admin-update.php?id=<?= $admin['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>

                <tr class="table-bar-footer" style="bottom: 0;">
                    <td colspan="9">
                        <?php
                            for ($i = 1; $i <= $number_of_page; $i++ ) {
                                ?>
                                    <a class="page-number <?php if ($page == $i) echo "current-page"; ?>" href="/manager/admins/admins-manager.php?page=<?= $i ?>"><?= $i ?></a>
                                <?php
                            }
                            ?>
                    </td>
                </tr>
            </table>
            </div>
            <!-- <br> -->
            <!-- <a href="#">Add new</a> -->
        </div>

    </div>
</body>
</html>
