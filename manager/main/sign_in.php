<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <form action="/manager/sign_in_process.php" method="POST">
        <input type="text" name="name" placeholder="Enter your account name"><br>
        <input type="password" name="pass" placeholder="Enter your account password"><br>
        <input type="submit" value="Sign in">
        <input type="reset" value="Reset">
    </form>
</body>
</html>