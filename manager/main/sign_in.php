<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <form action="/manager/main/sign_in_process.php" method="POST">
        Enter email: <input type="text" name="email"><br>
        Enter password: <input type="password" name="passwd"><br>
        <input type="submit" value="Sign in">
        <input type="reset" value="Reset">
    </form>
</body>
</html>