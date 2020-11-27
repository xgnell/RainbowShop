<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update Process</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $user_id = $_POST["id"];
        $user_email = $_POST["email"];
        $user_pass = $_POST["pass"];
        $user_phone = $_POST["phone"];

        sql_query("
            UPDATE user
            SET email='$user_email', pass='$user_pass', phone='$user_phone'
            WHERE id=$user_id;
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