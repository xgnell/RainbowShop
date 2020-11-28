<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Process</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $user_email = $_POST["email"];
        $user_pass = $_POST["pass"];
        $user_phone = $_POST["phone"];

        sql_query("
            INSERT INTO user(email, pass, phone)
            VALUES ('$user_email', '$user_pass', '$user_phone');
        ");
    ?>

    <div id="notification">Success</div>

    <script>
        setTimeout(function() {
            window.location.href = "/manager/customers/customers_manager.php";
        }, 1000);
    </script>
</body>
</html>