<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php"); ?>
</head>
<body>
    <form action="/manager/admins/admin_insert_process.php" method="POST">
        <input type="text" name="name" placeholder="Enter name">
        <br>
        <input type="password" name="pass" placeholder="Enter password">
        <br>
        <input type="submit" value="Sign up">
        <input type="reset" value="Reset">
    </form>
</body>
</html>