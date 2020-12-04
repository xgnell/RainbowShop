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
    <title>Items manager</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <?php require_once($root_path . "/config/db.php"); ?>
    <style>
        #item-table {
            width: 100%;
            border: 1px black solid;
            border-collapse: collapse;
            font-size: 20px;
        }
        #item-table .title {
            font-size: 25px;
            font-weight: bold;
            background-color: gray;
        }
        #item-table tr td {
            border: 1px black solid;
            padding: 5px 5px 5px 5px;
        }
    </style>
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
                $items = sql_query("
                    SELECT *
                    FROM items;
                ");
            ?>
            <table id="item-table">
                <tr>
                    <td hidden class="title">Id</td>
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
                <?php foreach($items as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?php if ($item['gender'] == 1) echo "Nam"; else echo "Nữ" ?></td>
                        <td><?= $item['birth'] ?></td>
                        <td><?= $item['phone'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= $item['passwd'] ?></td>
                        <td><?= $item['address'] ?></td>

                        <td><a href="/manager/items/item_update.php?id=<?= $item['id'] ?>">Update</a></td>
                        <td><a href="/manager/items/item_delete_process.php?id=<?= $item['id'] ?>">Delete</a></td>
                    </tr>
                <?php endforeach ?>
            </table>


        </div>

    </div>
</body>
</html>