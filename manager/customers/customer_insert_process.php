<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");

    // Get all input data
    $customer_name = $_POST["name"];
    $customer_gender = $_POST["gender"];
    $customer_birth = $_POST["birth"];
    $customer_phone = $_POST["phone"];
    $customer_email = $_POST["email"];
    $customer_passwd = $_POST["passwd"];
    $customer_address = $_POST["address"];


    // Insert new customer into database
    sql_query("
        INSERT INTO customers(name, gender, birth, phone, email, passwd, address)
        VALUES ('$customer_name', $customer_gender, '$customer_birth' , '$customer_phone', '$customer_email', '$customer_passwd', '$customer_address');
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Process</title>
</head>
<body>
    <?php include_once($root_path . "/manager/customers/customer_notification.php") ?>
</body>
</html>
