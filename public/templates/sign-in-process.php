<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

// Get sign in data
$customer_email = $_POST["email"];
$customer_passwd = $_POST["passwd"];

// Validate in database
$result = sql_query("
    SELECT *
    FROM customers
    WHERE email='$customer_email' AND passwd='$customer_passwd';
");

if (mysqli_num_rows($result) == 1) {
    // Sign in success
    $customer = mysqli_fetch_array($result);

    session_start();
    $_SESSION["user"] = [
        "type" => "customer",
        "customer" => [
            "id" => $customer["id"],
            "name" => $customer["name"],
            "cart" => []
        ]
    ];
    header("location:/public/home.php");
} else {
    // Sign in failure
    ?>
    <!-- //////////////////////////// Failure page ////////////////////////////// -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in failure</title>
    </head>
    <body>
        <h1>You typed wrong email or password</h1>
        <a href="/public/home.php">Back</a>
    </body>
    </html>
    <!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
<?php } ?>