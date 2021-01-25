<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get item id
    $background_id = $_GET["id"];

    // Delete item picture from server
    $background_picture = sql_query("
        SELECT picture
        FROM backgrounds
        WHERE id = $background_id;
    ");
    $background_picture_name = mysqli_fetch_array($background_picture)["picture"];
    unlink("../../public/assets/backgrounds/" . $background_picture_name);

    // Delete selected item from database
    sql_cmd("
        DELETE FROM backgrounds
        WHERE id = $background_id;
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
    
    <title>Quản lý background</title>
</head>
<body>
    <?php include_once($root_path . "/manager/backgrounds/background-notification.php") ?>
</body>
</html>
