<?php
    define("MENU_OPTION", "admin");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);
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
    <?php require_once($root_path . "/config/db.php"); ?>
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

                    <td>Sửa</td>
                    <td>Xóa</td>
                </tr>
                <?php foreach($admins as $admin): ?>
                    <?php
                        // Get admin rank name
                        $admin_rank_name = sql_query("
                            SELECT name
                            FROM admin_ranks
                            WHERE id = {$admin["id_rank"]};
                        ");
                        $admin_rank_name = mysqli_fetch_array($admin_rank_name)["name"];
                    ?>
                    <tr>
                        <td><?= $admin['name'] ?></td>
                        <td><?php if ($admin['gender'] == 1) echo "Nam"; else echo "Nữ" ?></td>
                        <td><?= $admin['birth'] ?></td>
                        <td><?= $admin['phone'] ?></td>
                        <td><?= $admin['email'] ?></td>
                        <td><?= $admin_rank_name ?></td>

                        <td>
                            <a class="btn-action" href="/manager/admins/admin-update.php?id=<?= $admin['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                            </a>
                        </td>
                        <td>
                            <a class="btn-action" href="/manager/admins/admin-delete-process.php?id=<?= $admin['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            </div>
            <!-- <br> -->
            <!-- <a href="#">Add new</a> -->
        </div>

    </div>
</body>
</html>
