<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Process</title>
</head>
<body>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

        $admin_id = $_POST["id"];
        $admin_name = $_POST["name"];
        $admin_pass = $_POST["pass"];

        sql_query("
            UPDATE admin
            SET name='$admin_name', pass='$admin_pass'
            WHERE id=$admin_id;
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