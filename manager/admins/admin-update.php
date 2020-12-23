<?php
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    // Get selected admin
    $admin_id = $_GET["id"];
    $admin = mysqli_fetch_array(sql_query("
        SELECT *
        FROM admins
        WHERE id=$admin_id;
    "));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <title>Admin Update</title>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        <!-- Main content -->
        <div class="page-content">
            <!-- Admin update form -->
            <form action="/manager/admins/admin-update-process.php" method="POST">
                <input type="number" name="id" value="<?= $admin["id"] ?>" hidden><br>
                Name: <input type="text" name="name" value="<?= $admin["name"] ?>"><br>
                Gender: <select name="gender">
                    <option value="1" <?php if ($admin["gender"] == 1) echo "selected"; ?> >Nam</option>
                    <option value="0" <?php if ($admin["gender"] == 0) echo "selected"; ?> >Nữ</option>
                </select>
                Birth: <input type="date" name="birth" value="<?= $admin["birth"] ?>"><br>
                Phone: <input type="text" name="phone" value="<?= $admin["phone"] ?>"><br>
                Email: <input type="text" name="email" value="<?= $admin["email"] ?>"><br>
                Password: <input type="password" name="passwd" value="<?= $admin["passwd"] ?>"><br>
                
                <?php
                    // Get admin ranks
                    $admin_ranks = sql_query("
                        SELECT *
                        FROM admin_ranks;
                    ");
                ?>
                Rank: <select name="rank">
                    <!-- Generate rank level options -->
                    <?php foreach ($admin_ranks as $admin_rank): ?>
                        <option value="<?= $admin_rank["id"] ?>" <?php if ($admin["id_rank"] == $admin_rank["id"]) echo "selected"; ?> ><?= $admin_rank["name"] ?></option>
                    <?php endforeach ?>
                </select><br>
                
                <input type="submit" value="Confirm">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>
</body>
</html>