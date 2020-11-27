<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins manager</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php"); ?>
    <style>
        #admin-table {
            width: 100%;
            border: 1px black solid;
            border-collapse: collapse;
            font-size: 20px;
        }
        #admin-table .title {
            font-size: 25px;
            font-weight: bold;
            background-color: gray;
        }
        #admin-table tr td {
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
                $admins = sql_query("
                    SELECT *
                    FROM admins;
                ");
            ?>
            <table id="admin-table">
                <tr>
                    <td hidden class="title">Id</td>
                    <td class="title">Name</td>
                    <td class="title">Gender</td>
                    <td class="title">Birth</td>
                    <td class="title">Phone</td>
                    <td class="title">Email</td>
                    <td class="title">Password</td>
                    <td class="title">Rank</td>

                    <!-- <td class="title">Add</td> -->
                    <td class="title">Update</td>
                    <td class="title">Delete</td>
                </tr>
                <?php foreach($admins as $admin) { ?>
                    <tr>
                        <!-- <td hidden><?php echo $admin['id'] ?></td> -->
                        <td><?php echo $admin['name'] ?></td>
                        <td><?php if ($admin['gender'] == 0) echo "Nam" else echo "Nữ" ?></td>
                        <td><?php echo $admin['birth'] ?></td>
                        <td><?php echo $admin['phone'] ?></td>
                        <td><?php echo $admin['email'] ?></td>
                        <td><?php echo $admin['passwd'] ?></td>
                        <td><?php echo $admin['rank'] ?></td>

                        <!-- <td><a href="#">Add</a></td> -->
                        <td><a href="/manager/admins/admin_update.php?id=<?php echo $admin['id'] ?>">Update</a></td>
                        <td><a href="/manager/admins/admin_delete_process.php?id=<?php echo $admin['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>


        </div>

    </div>
</body>
</html>