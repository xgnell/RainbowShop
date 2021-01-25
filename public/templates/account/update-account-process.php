<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/public/templates/account/check-customer-signed-in.php");
    check_customer_signed_in(1);

    require_once($root_path . "/config/db.php");

    if (empty($_POST["id"]) || empty($_POST["name"]) || empty($_POST["gender"]) || empty($_POST["birth_year"]) || empty($_POST["birth_month"]) || empty($_POST["birth_day"]) || empty($_POST["phone"]) || empty($_POST["email"]) || empty($_POST["passwd"]) || empty($_POST["address"])) {
        header('location:/public/templates/account/fail.php');
    }

    // Get all input data
    $customer_id = $_POST["id"];
    $customer_name = $_POST["name"];
    $customer_gender = $_POST["gender"];
    $customer_birth_year = $_POST["birth_year"];
    $customer_birth_month = $_POST["birth_month"];
    $customer_birth_day = $_POST["birth_day"];
    $customer_phone = $_POST["phone"];
    $customer_email = $_POST["email"];
    $customer_passwd = $_POST["passwd"];
    $customer_address = $_POST["address"];
    // Update selected customer in database
    sql_cmd("
        UPDATE customers
        SET name='$customer_name', gender=$customer_gender, birth='$customer_birth_year-$customer_birth_month-$customer_birth_day' , phone='$customer_phone', email='$customer_email', passwd='$customer_passwd', address='$customer_address'
        WHERE id=$customer_id;
    ");
    header('location:/public/templates/account/success.php');
?>