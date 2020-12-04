<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected customer
    $customer_id = $_GET["id"];
    $customer = mysqli_fetch_array(sql_query("
        SELECT *
        FROM customers
        WHERE id=$customer_id;
    "));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Customer Update</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Customer update form -->
            <form action="/manager/customers/customer_update_process.php" method="POST">
                <input type="number" name="id" value="<?= $customer["id"] ?>" hidden><br>
                Name: <input type="text" name="name" value="<?= $customer["name"] ?>"><br>
                Gender: <select name="gender" id="input_gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                <script>
                    // Set selected for gender options
                    let input_gender_options = document.querySelectorAll("#input_gender option");
                    for (let option of input_gender_options) {
                        if (option.value == <?= $customer['gender'] ?>) {
                            option.selected = "selected";
                            break;
                        }
                    }
                </script>
                Birth: <input type="date" name="birth" value="<?= $customer["birth"] ?>"><br>
                Phone: <input type="text" name="phone" value="<?= $customer["phone"] ?>"><br>
                Email: <input type="text" name="email" value="<?= $customer["email"] ?>"><br>
                Password: <input type="password" name="passwd" value="<?= $customer["passwd"] ?>"><br>
                Address: <input type="text" name="address" value="<?= $customer["address"] ?>"><br>
                
                <input type="submit" value="Confirm">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
</body>
</html>
