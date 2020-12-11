<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers manager</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <?php require_once($root_path . "/config/db.php"); ?>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <?php
                $customers = sql_query("
                    SELECT *
                    FROM customers;
                ");
            ?>

            <div class="scrollable">
            <table id="content-table">
                <tr>
                    <!-- <td hidden class="title">Id</td> -->
                    <td class="title">Name</td>
                    <td class="title">Gender</td>
                    <td class="title">Birth</td>
                    <td class="title">Phone</td>
                    <td class="title">Email</td>
                    <td class="title">Password</td>
                    <td class="title">Address</td>

                    <td class="title">Update</td>
                    <td class="title">Delete</td>
                </tr>
                <?php foreach($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['name'] ?></td>
                        <td><?php if ($customer['gender'] == 1) echo "Nam"; else echo "Nữ" ?></td>
                        <td><?= $customer['birth'] ?></td>
                        <td><?= $customer['phone'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= $customer['passwd'] ?></td>
                        <td><?= $customer['address'] ?></td>

                        <td><a href="/manager/customers/customer_update.php?id=<?= $customer['id'] ?>">Update</a></td>
                        <td><a href="/manager/customers/customer_delete_process.php?id=<?= $customer['id'] ?>">Delete</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
            </div>
            <br>
            <a href="#">Add new</a>
        </div>

    </div>
</body>
</html>
