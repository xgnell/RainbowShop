<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");

$admin_name = $_POST["name"];
$admin_pass = $_POST["pass"];

$result = sql_query("
    SELECT *
    FROM 
");