<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];

    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get customer id
    $customer_id = $_GET["id"];

    // Delete selected customer from database
    sql_query("
        DELETE FROM customers
        WHERE id=$customer_id;
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Delete Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/customers/customer_notification.php") ?>
</body>
</html>
