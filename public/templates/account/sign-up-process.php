<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
$notification_title = "Rainbow Kitty";
$return_path = "/public/templates/account/sign-up.php";
require_once($root_path . "/config/db.php");
require_once($root_path . "/public/templates/ui/notification/notification-page.php");
require_once($root_path . "/public/templates/account/signup-notification.php");

//Lấy hết dữ liệu từ form gửi lên
$customer = null;
if (!empty($_POST)) {
    $customer = [
        'name' => htmlspecialchars($_POST["name"] ?? null),
        'email' => htmlspecialchars($_POST["email"] ?? null),
        'gender' => htmlspecialchars($_POST["gender"] ?? null),
        'address' => htmlspecialchars($_POST["address"] ?? null),
        'birth_year' => htmlspecialchars($_POST["birth_year"] ?? null),
        'birth_month' => htmlspecialchars($_POST["birth_month"] ?? null),
        'birth_day' => htmlspecialchars($_POST["birth_day"] ?? null),
    	'phone' => htmlspecialchars($_POST["phone"] ?? null)
    ];
    $customer_passwd = htmlspecialchars($_POST["passwd"] ?? null);
} else {
    display_front_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước đó
    );
    exit();
}

/*********** Validate dữ liệu ************/

$regex = [
    'name' => "/^(?:[a-zA-Z]+\ ?)+[a-zA-Z]$/",
    'gender' => "/^[1-3]$/",
    'phone' => "/^0[0-9]{9,9}$/",
    'email' => "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/"
];
/* Kiểm tra tính hợp lệ */
// Kiểm tra tên
function remove_ascent ($name) {
    if ($name === null) return $name;
    $name = strtolower($name);
    $name = preg_replace("/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ầ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/", "a", $name);
    $name = preg_replace("/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/", "e", $name);
    $name = preg_replace("/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ/", "i", $name);
    $name = preg_replace("/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/", "o", $name);
    $name = preg_replace("/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/", "u", $name);
    $name = preg_replace("/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/", "y", $name);
    $name = preg_replace("/đ|Đ/", "d", $name);
    return $name;
}
$customer_name = remove_ascent($customer['name']);
if ($customer['name'] == null || !preg_match($regex["name"], $customer_name)) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Tên không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra giới tính
if ($customer['gender'] == null || !preg_match($regex["gender"], $customer["gender"])) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Giới tính không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra email
if ($customer['email'] == null || !preg_match($regex['email'], $customer['email'])) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Email không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra địa chỉ
if ($customer['address'] == null) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Địa chỉ không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra ngày tháng năm sinh
if ($customer['birth_year'] == null || !is_numeric($customer['birth_year']) || $customer['birth_year'] < 1900 || $customer['birth_year'] > date("Y")) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Năm sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}
if ($customer['birth_month'] == null || !is_numeric($customer['birth_month']) || $customer['birth_month'] < 1 || $customer['birth_month'] > 12) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Tháng sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
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
if ($customer['birth_day'] == null || !is_numeric($customer['birth_day']) ||
    !is_valid_birth_day(
        $customer['birth_year'],
        $customer['birth_month'],
        $customer['birth_day']
    )) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Ngày sinh không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra số điện thoại
if ($customer['phone'] == null || !preg_match($regex['phone'], $customer['phone'])) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Số điện thoại không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}
// Kiểm tra số điện thoại có trùng
$customer_phone = sql_query("
    SELECT *
    FROM customers
    WHERE phone = '{$customer['phone']}';
");
if (mysqli_num_rows($customer_phone) != 0) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Số điện thoại đã tồn tại",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra email
if ($customer['email'] == null || !preg_match($regex['email'], $customer['email'])) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Email không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}
// Kiểm tra email có trùng
$customer_email = sql_query("
    SELECT *
    FROM customers
    WHERE email = '{$customer['email']}';
");
if (mysqli_num_rows($customer_email) != 0) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Email đã tồn tại",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Kiểm tra passwd
if ($customer_passwd == null || preg_match('/(\'|\"|\#|\;|\ )/', $customer_passwd)) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Mật khẩu không hợp lệ",
        "",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}
// Kiểm tra độ mạnh mật khẩu
if (!preg_match("/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})/", $customer_passwd)) {
    display_signup_notification_page(
        false,
        $notification_title,
        "Mật khẩu không đủ mạnh",
        "Mật khẩu phải chứa ít nhất 8 kí tự, bao gồm cả số, chữ và các kí tự đặc biệt được cho phép",
        "Thử lại",
        $return_path,
        $customer
    );
    exit();
}

// Thêm customer mới vào trong cơ sở dữ liệu
$customer_birth = $customer["birth_year"] . "-" . $customer["birth_month"] . "-" . $customer["birth_day"];
sql_cmd("
    INSERT INTO customers(
        name,
        gender,
		birth,
		address,
        phone,
        email,
        passwd,
        id_state
    )
    VALUES (
        '{$customer["name"]}',
        {$customer["gender"]},
		'$customer_birth',
		'{$customer["address"]}',
        '{$customer["phone"]}',
        '{$customer["email"]}',
        '$customer_passwd',
        1
    );
");
display_front_notification_page(
    true,
    $notification_title,
    "Đăng kí tài khoản thành công",
    "",
    "Quay lại",
    "/public/home.php"
);