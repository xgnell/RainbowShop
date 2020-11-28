<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users manager</title>
    <link rel="stylesheet" href="../templates/css/all.css">
    <link rel="stylesheet" href="../templates/css/layout.css">
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php"); ?>
    <style>
        #user-table {
            width: 100%;
            border: 1px black solid;
            border-collapse: collapse;
            font-size: 20px;
        }
        #user-table .title {
            font-size: 25px;
            font-weight: bold;
            background-color: gray;
        }
        #user-table tr td {
            border: 1px black solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
</head>
<body>
    <!-- Header menu -->
    <?php include_once("../templates/header.php"); ?>

    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once("../templates/menu.php"); ?>

        <!-- Main content -->
        <div class="page-content">
            <?php
                $users = sql_query("
                    SELECT *
                    FROM user;
                ");
            ?>
            <table id="user-table">
                <tr>
                    <td hidden class="title">Id</td>
                    <td class="title">Email</td>
                    <td class="title">Password</td>
                    <td class="title">Phone</td>

                    <!-- <td class="title">Add</td> -->
                    <td class="title">Update</td>
                    <td class="title">Delete</td>
                </tr>
                <?php foreach($users as $user) { ?>
                    <tr>
                        <!-- <td hidden><?php echo $user['id'] ?></td> -->
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['pass'] ?></td>
                        <td><?php echo $user['phone'] ?></td>

                        <!-- <td><a href="#">Add</a></td> -->
                        <td><a href="/manager/customers/customer_update.php?id=<?php echo $user['id'] ?>">Update</a></td>
                        <td><a href="/manager/customers/customer_delete_process.php?id=<?php echo $user['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>


        </div>

    </div>
</body>
</html>