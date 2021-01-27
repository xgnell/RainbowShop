<?php
    define("MENU_OPTION", "contact");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/background.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý background</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <style>
        #display-size {
            width: 100%;
            border: 1px #ccc solid;
            border-collapse: collapse;
            /* margin: 5px 5px 5px 5px; */
        }
        #display-size tr td {
            border: 1px #ccc solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
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
                        <td>Số điện thoại liên hệ</td>
                        <td>Địa chỉ</td>
                        <td>Sửa thông tin</td>
                    </tr>
                    <tr>
                        <td>
                            <?= $phone["value"] ?>
                        </td>
                        <td>
                            <?= $address["value"] ?>
                        </td>
                        <td>
                            <a href="">
                                
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>