<?php
/** Validate
 * Kiểm tra tính hợp lệ (không phân biệt trống hay ko)
 * Kiểm tra id có tồn tại trong cơ sở dữ liệu hay ko
 * Kiểm tra có bị trùng lặp trong cơ sở dữ liệu hay không (phone, email)
 * Kiểm tra passwd có đủ mạnh hay không
 */

$notification_title = "Thay đổi thông tin tài khoản admin";
$return_path = "/manager/admins/admin-change.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");

require_once($root_path . "/config/db.php");
require_once($root_path . "/config/default.php");
require_once($root_path . "/manager/admins/admin-notification.php");
require_once($root_path . "/manager/templates/notification-page.php");

// Lấy tất cả dữ liệu từ form gửi lên
$admin_id = $_POST["id"] ?? null;
if ($admin_id == null) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}

check_exact_admin_signed_in($admin_id);

$admin = null;
if (!empty($_POST)) {
    $admin = [
        'id' => htmlspecialchars($admin_id),
        'name' => htmlspecialchars($_POST["name"] ?? null),
        'gender' => htmlspecialchars($_POST["gender"] ?? null),
        
        'birth_year' => htmlspecialchars($_POST["birth_year"] ?? null),
        'birth_month' => htmlspecialchars($_POST["birth_month"] ?? null),
        'birth_day' => htmlspecialchars($_POST["birth_day"] ?? null),
    
        'phone' => htmlspecialchars($_POST["phone"] ?? null),
        'email' => htmlspecialchars($_POST["email"] ?? null)
    ];
    $admin_passwd = htmlspecialchars($_POST["passwd"] ?? null);
} else {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}

/***** Validate dữ liệu *****/
$regex = [
    'name' => "/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/",
    'gender' => "/^[1-3]$/",
    'phone' => "/^0[0-9]{9,9}$/",
    'email' => "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/"
];
/* Kiểm tra tính hợp lệ */
// Kiểm tra id
if (!is_numeric($admin["id"])) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}
$admin_id = sql_query("
    SELECT *
    FROM admins
    WHERE id = {$admin['id']};
");
if (mysqli_num_rows($admin_id) != 1) {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay lại trang trước đó
    );
    exit();
}
$return_path .= "?id={$admin['id']}";


// Kiểm tra tên
function remove_ascent ($name) {
    if ($name === null) return $name;
    $name = preg_replace("/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ầ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/", "a", $name);
    $name = preg_replace("/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/", "e", $name);
    $name = preg_replace("/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ/", "i", $name);
    $name = preg_replace("/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/", "o", $name);
    $name = preg_replace("/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/", "u", $name);
    $name = preg_replace("/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/", "y", $name);
    $name = preg_replace("/đ|Đ/", "d", $name);
    $name = strtolower($name);
    return $name;
}
$admin_name = remove_ascent($admin['name']);
if ($admin['name'] == null || !preg_match($regex["name"], $admin_name)) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Tên không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

// Kiểm tra giới tính
if ($admin['gender'] == null || !preg_match($regex["gender"], $admin["gender"])) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Giới tính không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

// Kiểm tra ngày tháng năm sinh
if ($admin['birth_year'] == null || !is_numeric($admin['birth_year']) || $admin['birth_year'] < 1900 || $admin['birth_year'] > date("Y")) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Năm sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}
if ($admin['birth_month'] == null || !is_numeric($admin['birth_month']) || $admin['birth_month'] < 1 || $admin['birth_month'] > 12) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Tháng sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

function is_leap_year($year) {
    return ($year % 100 === 0) ? ($year % 400 === 0) : ($year % 4 === 0); 
}
function is_valid_birth_day($year, $month, $day) {
    $max_day = 0;
    if (in_array($month, [1, 3, 5, 7, 8, 10, 12])) {
        $max_day = 31;
    } else if (in_array($month, [4, 6, 9, 11])) {
        $max_day = 30;
    } else {
        if (is_leap_year($year)) {
            $max_day = 29;
        } else {
            $max_day = 28;
        }
    }
    if (1 <= $day && $day <= $max_day) return true; else return false;
}
if ($admin['birth_day'] == null || !is_numeric($admin['birth_day']) ||
    !is_valid_birth_day(
        $admin['birth_year'],
        $admin['birth_month'],
        $admin['birth_day']
    )) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Ngày sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

// Kiểm tra số điện thoại
if ($admin['phone'] == null || !preg_match($regex['phone'], $admin['phone'])) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Số điện thoại không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}
// Kiểm tra số điện thoại có trùng
$admin_old_phone = sql_query("
    SELECT phone
    FROM admins
    WHERE id = {$admin['id']};
");
$admin_old_phone = mysqli_fetch_array($admin_old_phone)["phone"];
$admin_phone = sql_query("
    SELECT *
    FROM admins
    WHERE phone = '{$admin['phone']}';
");
if (mysqli_num_rows($admin_phone) != 0 && mysqli_fetch_array($admin_phone)['id'] != $admin['id']) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Số điện thoại đã tồn tại",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

// Kiểm tra email
if ($admin['email'] == null || !preg_match($regex['email'], $admin['email'])) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Email không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}
// Kiểm tra email có trùng
$admin_old_email = sql_query("
    SELECT email
    FROM admins
    WHERE id = {$admin['id']};
");
$admin_old_email = mysqli_fetch_array($admin_old_email)["email"];
$admin_email = sql_query("
    SELECT *
    FROM admins
    WHERE email = '{$admin['email']}';
");
if (mysqli_num_rows($admin_email) != 0 && mysqli_fetch_array($admin_email)['id'] != $admin['id']) {
    display_admin_notification_page(
        false,
        $notification_title,
        "Email đã tồn tại",
        "",
        "Thử lại",
        $return_path,
        $admin
    );
    exit();
}

// Kiểm tra password
if ($admin["id"] == $_SESSION["user"]["admin"]["id"]) {
    // Admin hiện tại đang đăng nhập
    // Kiểm tra tính hợp lệ
    if ($admin_passwd == null || preg_match('/(\'|\"|\#|\;|\ )/', $admin_passwd)) {
        display_admin_notification_page(
            false,
            $notification_title,
            "Mật khẩu không hợp lệ",
            "",
            "Thử lại",
            $return_path,
            $admin
        );
        exit();
    }
    // Kiểm tra độ mạnh mật khẩu
    if (!preg_match("/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})/", $admin_passwd)) {
        display_admin_notification_page(
            false,
            $notification_title,
            "Mật khẩu không đủ mạnh",
            "Mật khẩu phải chứa ít nhất 8 kí tự, bao gồm cả số, chữ và các kí tự đặc biệt được cho phép",
            "Thử lại",
            $return_path,
            $admin
        );
        exit();
    }
} else {
    // Admin khác
    $admin_reset_passwd = $_POST["reset-passwd"];
    if ($admin_reset_passwd == 'reset') {
        $admin_passwd = DEFAULT_ADMIN_PASSWORD;
    } else if ($admin_reset_passwd == 'keep') {
        $admin_passwd = sql_query("
            SELECT passwd
            FROM admins
            WHERE id = {$admin['id']};
        ");
        $admin_passwd = mysqli_fetch_array($admin_passwd)['passwd'];
    } else {
        display_admin_notification_page(
            false,
            $notification_title,
            "Mật khẩu không hợp lệ",
            "Bạn phải lựa chọn giữ lại mật khẩu cũ hoặc reset về mật khẩu mặc định ",
            "Thử lại",
            $return_path,
            $admin
        );
        exit();
    }
}

// Update admin trong cơ sở dữ liệu
$admin_birth = $admin["birth_year"] . "-" . $admin["birth_month"] . "-" . $admin["birth_day"];
sql_cmd("
    UPDATE admins
    SET
        name = '{$admin["name"]}',
        gender = {$admin["gender"]},
        birth = '$admin_birth',
        phone = '{$admin["phone"]}',
        email = '{$admin["email"]}',
        passwd = '$admin_passwd'
    WHERE
        id = {$admin['id']};
");
display_notification_page(
    true,
    $notification_title,
    "Sửa thành công",
    "",
    "Quay về trang chủ admin",
    "/manager/main/main-manager.php"
);
