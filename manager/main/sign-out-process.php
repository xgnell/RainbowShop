<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

session_start();
session_destroy();
header("location:/manager/main/sign-in.php");
