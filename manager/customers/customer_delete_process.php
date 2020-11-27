<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Delete Process</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $user_id = $_GET["id"];

        sql_query("
            DELETE FROM user
            WHERE id=$user_id;
        ");
    ?>

    <div id="notification">Success</div>

    <script>
        setTimeout(function() {
            window.location.href = "/manager/customers/customer_manager.php";
        }, 1000);
    </script>
</body>
</html>