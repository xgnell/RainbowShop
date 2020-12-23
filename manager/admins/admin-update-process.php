<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($root_path . "/config/db.php");

    // Get all input data
    $admin_id = $_POST["id"];
    $admin_name = $_POST["name"];
    $admin_gender = $_POST["gender"];
    $admin_birth = $_POST["birth"];
    $admin_phone = $_POST["phone"];
    $admin_email = $_POST["email"];
    $admin_passwd = $_POST["passwd"];
    $admin_rank_id = $_POST["rank"];

    // Update selected admin in database
    sql_cmd("
        UPDATE admins
        SET name = '$admin_name', gender = $admin_gender, birth = '$admin_birth' , phone = '$admin_phone', email = '$admin_email', passwd = '$admin_passwd', id_rank = $admin_rank_id
        WHERE id = $admin_id;
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Process</title>
</head>
<body>
    <?php include_once($root_path. "/manager/admins/admin-notification.php") ?>
</body>
</html>
