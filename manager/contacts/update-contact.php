<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/prevent-expired.php");

    define("MENU_OPTION", "contact");
    $root_path = $_SERVER["DOCUMENT_ROOT"];
    
    // Check signed in
    require_once($root_path . "/manager/templates/check-admin-signed-in.php");
    check_admin_signed_in(2);

    require_once($root_path . "/config/db.php");
    require_once($root_path . "/manager/templates/notification-page.php");
    require_once($root_path . "/manager/contacts/contact-notification.php");

    // Lấy dữ liệu được gủi lại từ form
    $contact = null;
    if (!empty($_POST)) {
        $contact = [
            'phone' => $_POST['phone'] ?? "",
            'address' => $_POST['address'] ?? ""
        ];
    } else {
        $contact = [
            'phone' => mysqli_fetch_array(sql_query("
                select *
                from contact
                where id = 1
            "))['value'],
            'address' => mysqli_fetch_array(sql_query("
                select *
                from contact
                where id = 2
            "))['value']
        ];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    
    <title>Quản lý liên hệ</title>
    <link rel="stylesheet" href="/manager/templates/css/all.css">
    <link rel="stylesheet" href="/manager/templates/css/layout.css">
    <script src="/manager/templates/js/common-validate.js"></script>
</head>
<body>
    <!-- Header menu -->
    <?php include_once($root_path . "/manager/templates/header.php"); ?>
    <div class="page-body">
        <!-- Slide menu -->
        <div class="page-menu">
            <?php include_once($root_path . "/manager/templates/menu.php"); ?>
        </div>
        <!-- Main content -->
        <div class="page-content">
            <form onsubmit="return validate_all({
                phone: [/^0[0-9]{9,9}$/, 'Số điện thoại không hợp lệ (Số điện thoại gồm 10 đến 11 số và chỉ chấp nhận số)'],
            },
            [],
            ['address']);"
                
                action="/manager/contacts/update-contact-process.php" method="POST">
                <table class="edit-table">
                    <tr>
                        <td rowspan="2" class="table-title">
                            Điện thoại liên hệ
                        </td>
                        <td>
                            <input type="text" id="input-phone" name="phone" value="<?= $contact['phone'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-phone"></td>
                    </tr>

                    <tr>
                        <td rowspan="2" class="table-title">
                            Địa chỉ
                        </td>
                        <td>
                            <textarea name="address" id="input-address"><?= $contact['address'] ?></textarea>
                        </td>  
                    </tr>
                    <tr>
                        <td class="display-error" id="display-error-address"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="action-area">
                                <input type="submit" value="Xác nhận sửa">
                                <input type="reset" value="Làm lại">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>