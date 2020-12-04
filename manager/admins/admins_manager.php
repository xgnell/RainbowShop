<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check_signed_in.php");
    check_admin_signed_in(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins manager</title>
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
                $admins = sql_query("
                    SELECT *
                    FROM admins;
                ");
            ?>

            <div class="scrollable">
            <table id="content-table">
                <tr>
                    <td hidden class="title">Id</td>
                    <td class="title">Name</td>
                    <td class="title">Gender</td>
                    <td class="title">Birth</td>
                    <td class="title">Phone</td>
                    <td class="title">Email</td>
                    <td class="title">Password</td>
                    <td class="title">Rank</td>

                    <td class="title">Update</td>
                    <td class="title">Delete</td>
                </tr>
                <?php foreach($admins as $admin): ?>
                    <tr>
                        <td><?= $admin['name'] ?></td>
                        <td><?php if ($admin['gender'] == 1) echo "Nam"; else echo "Nữ" ?></td>
                        <td><?= $admin['birth'] ?></td>
                        <td><?= $admin['phone'] ?></td>
                        <td><?= $admin['email'] ?></td>
                        <td><?= $admin['passwd'] ?></td>
                        <td><?= $admin['rank'] ?></td>

                        <td><a href="/manager/admins/admin_update.php?id=<?= $admin['id'] ?>">Update</a></td>
                        <td><a href="/manager/admins/admin_delete_process.php?id=<?= $admin['id'] ?>">Delete</a></td>
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
