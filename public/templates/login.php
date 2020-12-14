<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        #div_all {
            margin: auto;
            margin-top: 10%;
            background-color: khaki;
            width: 400px;
            height: 500px;
            vertical-align: auto;
        }
        #div_login {
            width: 100%;
            height: 60%;
            background-color: palegreen;
        }
        #div_signup {
            width: 100%;
            height: 40%;
            background-color:paleturquoise;
        }
    </style>
</head>
<body>
    <div id="div_all">
        <div id="div_login">
            <form action="login_process.php" method="post">
                <table border="1">
                    <tr>
                        <td>
                            <h2>Login</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nhập email tài khoản của bạn
                            <br>
                            <input type="text" placeholder="Enter email" name="email_customer">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nhập password
                            <br>
                            <input type="password" placeholder="Enter password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Login">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="div_signup">
            Sign up
        </div>
    </div>
</body>
</html>