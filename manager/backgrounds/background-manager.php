<?php
    define("MENU_OPTION", "background");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/config/background.php");

    $pagination_table = 'backgrounds';
    require_once($root_path . "/manager/templates/pagination-header.php");
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
        <div class="page-content">
            <?php
                // Get all background
                $backgrounds = sql_query("
                    SELECT *
                    FROM backgrounds;
                ");
            ?>
            <div class="scrollable">
            <table id="content-table">
                <tr class="table-bar-header" style="top: 0;">
                    <td>Tên ảnh</td>
                    <td>Ảnh</td>

                    <td>Xoá</td>
                </tr>
                <tr>
                    <?php foreach($backgrounds as $background): ?>
                        <tr>
                            <td><?php echo $background["name"] ?></td>

                            <td><img style="height: 200px;" src="<?= BACKGROUND_IMAGE_SOURCE_PATH . $background['picture'] ?>"></td>
                            
                            <td>
                                <a class="btn-action" href="/manager/backgrounds/background-delete-process.php?id=<?= $background['id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="36px" height="36px"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>