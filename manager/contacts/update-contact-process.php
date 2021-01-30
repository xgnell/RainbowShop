<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

$notification_title = "Quản lý liên hệ";
$return_path = "/manager/contacts/update-contact.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(1);

require_once($_SERVER["DOCUMENT_ROOT"] . "/config/db.php");
require_once($root_path . "/manager/contacts/contact-notification.php");
require_once($root_path . "/manager/templates/notification-page.php");

if (empty($_POST)) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Về trang trước đó
    );
    exit();
}

$contact = [
    'phone' => htmlspecialchars($_POST['phone'] ?? null),
    'address' => htmlspecialchars($_POST['address'] ?? null)
];

// Validate dữ liệu
// Kiểm tra số điện thoại
$regex_phone = "/^0[0-9]{9,10}$/";
if ($contact['phone'] == null ||
    !is_numeric($contact['phone']) || 
    !preg_match($regex_phone, $contact['phone']))
{

    display_contact_notification_page(
        false,
        $notification_title,
        "Số điện thoại không hợp lệ",
        "",
        "Quay lại",
        $return_path,
        $contact
    );
    exit();
}


// Kiểm tra địa chỉ
if ($contact['address'] == null) {
    display_contact_notification_page(
        false,
        $notification_title,
        "Địa chỉ không hợp lệ",
        "",
        "Quay lại",
        $return_path,
        $contact
    );
    exit();
}

$sql_phone = "
    update contact
    set value = '{$contact['phone']}'
    where id = 1
";
$sql_address = "
    update contact
    set value = '{$contact['address']}'
    where id = 2
";

sql_query($sql_phone);
sql_query($sql_address);

display_notification_page(
    true,
    $notification_title,
    "Sửa thông tin liên hệ thành công",
    "",
    "Quay lại",
    "/manager/contacts/view-contact.php"
);