<?php
    define("MENU_OPTION", "background");
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
    
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Quản lý background</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <form action="/manager/backgrounds/background-insert-process.php" method="POST" enctype="multipart/form-data">
                <div style="width: 100%; display:flex;"></div>
                <!-- Tên -->
                <table class="edit-table">
                    <tr>
                        <td class="table-title" rowspan="2">
                            Tên ảnh
                        </td>
                        <td>
                            <input id="input-name" type="text" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-name"></td>
                    </tr>
                    <!-- Ảnh -->
                    <tr>
                        <td class="table-title" rowspan="2">
                            Ảnh
                        </td>
                        <td>
                            <input id="input-picture" type="file" name="picture">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-picture"></td>
                    </tr>
                    
                    <!-- Action -->
                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Thêm background">
                                <input type="reset" value="Làm lại">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>