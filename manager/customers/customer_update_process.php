<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get all input data
    $customer_id = $_POST["id"];
    $customer_name = $_POST["name"];
    $customer_gender = $_POST["gender"];
    $customer_birth = $_POST["birth"];
    $customer_phone = $_POST["phone"];
    $customer_email = $_POST["email"];
    $customer_passwd = $_POST["passwd"];
    $customer_address = $_POST["address"];

    // Update selected customer in database
    sql_query("
        UPDATE customers
        SET name='$customer_name', gender=$customer_gender, birth='$customer_birth' , phone='$customer_phone', email='$customer_email', passwd='$customer_passwd', address='$customer_address'
        WHERE id=$customer_id;
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Update Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/customers/customer_notification.php") ?>
</body>
</html>
