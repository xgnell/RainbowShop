<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

// Get all signup data
$customer_name = $_POST["name"];
$customer_email = $_POST["email"];
$customer_gender = $_POST["gender"];
$customer_passwd = $_POST["passwd"];
$customer_address = $_POST["address"];
$customer_birth = $_POST["birth"];
$customer_phone = $_POST["phone"];

sql_cmd("
	INSERT INTO customers (name, gender, birth, phone, email, passwd, address)
	VALUES ('$customer_name', $customer_gender, '$customer_birth', '$customer_phone', '$customer_email', '$customer_passwd', '$customer_address');
");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up success</title>
</head>
<body>
	success
	<a href="/public/home.php">Back to home page</a>
</body>
</html>