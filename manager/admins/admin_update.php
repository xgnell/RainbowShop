<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $admin_id = $_GET["id"];
        $admin = mysqli_fetch_array(sql_query("
            SELECT *
            FROM admins
            WHERE id=$admin_id;
        "));
    ?>
    <form action="/manager/admins/admin_update_process.php" method="POST">
        <input type="number" name="id" value="<?php echo $admin['id'] ?>" hidden><br>
        <input type="text" name="name" placeholder="Name" value="<?php echo $admin['name'] ?>"><br>
        <input type="text" name="gender" placeholder="Gender" value="<?php echo $admin['name'] ?>"><br>
        <input type="text" name="birth" placeholder="Name" value="<?php echo $admin['name'] ?>"><br>
        <input type="text" name="phone" placeholder="Name" value="<?php echo $admin['name'] ?>"><br>
        <input type="text" name="email" placeholder="Name" value="<?php echo $admin['name'] ?>"><br>
        <input type="password" name="pass" placeholder="Password" value="<?php echo $admin['pass'] ?>"><br>
        <input type="text" name="rank" placeholder="Name" value="<?php echo $admin['name'] ?>"><br>

        <input type="submit" value="Confirm">
        <input type="reset" value="Reset">
    </form>
</body>
</html>