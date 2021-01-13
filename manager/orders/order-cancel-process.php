<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
    
// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
require_once($root_path . "/config/db.php");
check_admin_signed_in(2);

$bill_id = $_GET["id"];
sql_cmd("
    UPDATE bills
    SET id_state = 3
    WHERE id = $bill_id;
");

header("location:/manager/orders/orders-manager.php");