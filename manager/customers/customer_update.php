<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $user_id = $_GET["id"];
        $user = mysqli_fetch_array(sql_query("
            SELECT *
            FROM user
            WHERE id=$user_id;
        "));
    ?>
    <form action="/manager/customers/customer_update_process.php" method="POST">
        <input type="number" name="id" value="<?php echo $user['id'] ?>" hidden><br>
        <input type="text" name="email" placeholder="Email" value="<?php echo $user['email'] ?>"><br>
        <input type="password" name="pass" placeholder="Password" value="<?php echo $user['pass'] ?>"><br>
        <input type="text" name="phone" placeholder="Phone" value="<?php echo $user['phone'] ?>"><br>        
        <input type="submit" value="Confirm">
        <input type="reset" value="Reset">
    </form>
</body>
</html>