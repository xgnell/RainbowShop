<?php
     require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

     define("MENU_OPTION", "admin");
     $notification_title = "Quản lý admin";
     $root_path = $_SERVER["DOCUMENT_ROOT"];
     
     // Check signed in
     require_once($root_path . "/manager/templates/check-admin-signed-in.php");
     check_admin_signed_in(1);
 
     require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
     require_once($root_path . "/manager/admins/admin-notification.php");
     require_once($root_path . "/manager/templates/notification-page.php");
 
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql_phone = "
        update contact
        set value = '$phone'
        where id = 1
    ";
    $sql_address = "
        update contact
        set value = '$address'
        where id = 2
    ";

    sql_query($sql_phone);
    sql_query($sql_address);

    header('location:/manager/contact/view-contact.php');
?>