<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    if (empty($_POST["name"]) || empty($_FILES["picture"])) {
        header('location:/manager/backgrounds/fail.php');
        exit();
    }

     // Get all input data
     $item_name = $_POST["name"];
     $item_picture = $_FILES["picture"];

     // Handle picture
    $item_picture_name = $item_picture["name"];
    move_uploaded_file($item_picture["tmp_name"], "../../public/assets/backgrounds/" . $item_picture_name);

    // Insert new background into database
    sql_cmd("
        INSERT INTO backgrounds(name, picture)
        VALUES ('$item_name', '$item_picture_name');
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