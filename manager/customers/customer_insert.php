<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Add Customer</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Customer insertion form -->
            <form action="/manager/customers/customer_insert_process.php" method="POST">
                Enter name: <input type="text" name="name"><br>
                Choose gender: <select name="gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                Enter birth: <input type="date" name="birth"><br>
                Enter phone: <input type="text" name="phone"><br>
                Enter email: <input type="text" name="email"><br>
                Enter password: <input type="password" name="passwd"><br>
                Enter address: <input type="text" name="address">
                <br>
                <input type="submit" value="Sign up">
                <input type="reset" value="Reset">
            </form>  
        </div>
    </div>
</body>
</html>
