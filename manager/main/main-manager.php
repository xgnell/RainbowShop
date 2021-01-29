<?php
    define("MENU_OPTION", "main");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Super Kitty</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <style>
        .background {
            width: 100%;
            height: 100%;
            background-image: url('/public/assets/backgrounds/nyancat.jpg');
            background-size: cover;
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
        <div class="page-content" style="padding: 0; margin: 0; text-align: center;">
            <div class="background">
                <h1 style="color: yellow; padding-top: 35px; font-size: 3em;">Rainbow Kitty</h1>
            </div>
        </div>

    </div>
</body>
</html>
