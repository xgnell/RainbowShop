<?php
    define("MENU_OPTION", "contact");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý liên hệ</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <div class="page-menu">
            <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        </div>
        <!-- Main content -->
        <?php
            $sql_phone = "
                select *
                from contact
                where id = 1
            ";
            $sql_address = "
                select *
                from contact
                where id = 2
            ";
            $phone = mysqli_fetch_array(sql_query($sql_phone));
            $address = mysqli_fetch_array(sql_query($sql_address));
        ?>
        <div class="page-content">
            <div class="scrollable">
                <table id="content-table">
                    <tr class="table-bar-header" style="top: 0;">
                        <td style="min-width: 220px;">Điện thoại liên hệ</td>
                        <td>Địa chỉ</td>
                        <td>Sửa</td>
                    </tr>
                    <tr>
                        <td>
                            <?= $phone["value"] ?>
                        </td>
                        <td>
                            <?= $address["value"] ?>
                        </td>
                        <td>
                            <a class="btn-action" href="/manager/contacts/update-contact.php">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>