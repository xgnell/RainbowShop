<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Process</title>
</head>
<body>
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

    $admin_name = $_POST["name"];
    $admin_pass = $_POST["pass"];

    sql_query("
        INSERT INTO admin(name, pass)
        VALUES ('$admin_name', '$admin_pass');
    ");
    ?>

    <div id="notification">Success</div>

    <script>
        setTimeout(function() {
            window.location.href = "/manager/admins/admins_manager.php";
        }, 1000);
    </script>
</body>
</html>

