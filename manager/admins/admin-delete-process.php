<?php 
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(1);

    require_once($root_path . "/config/db.php");

    // Get admin id
    $admin_id = $_GET["id"];

    // Check for self delete
    if ($_SESSION["user"]["admin"]["id"] == $admin_id) {
    ?>
        <!-- //////////////////////////// Check delete self page ///////////////////// -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Check delete self</title>
        </head>
        <body>
            <h1>You cannot delete yourself</h1>
            <a href="/manager/admins/admins-manager.php">Back to admin manager</a>
        </body>
        </html>
        <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
    <?php
    } else {
        // Delete selected admin from database
        sql_cmd("
            DELETE FROM admins
            WHERE id = $admin_id;
        ");
        ?>
        <!-- ///////////////////////////// Notification page //////////////////////// -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Delete Process</title>
        </head>
        <body>
            <?php include_once($root_path . "/manager/admins/admin-notification.php") ?>
        </body>
        </html>
        <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
<?php } ?>
