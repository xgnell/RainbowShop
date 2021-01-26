<?php
// error_reporting(0);
require_once($_SERVER["DOCUMENT_ROOT"] . "/notification/display-error-page.php");
if (basename($_SERVER['PHP_SELF']) == "db.php") {
    display_error_page(404, "Không tìm thấy trang");
    exit();
}


define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB_NAME", "bigprojectone");

// Sửa lỗi access denied phpMyAdmin nhưng ko xuất hiện ở web


// Hàm trả về có return
function sql_query(string $query_msg) {
    $connect = mysqli_connect(
        SERVER_NAME,
        USERNAME,
        PASSWORD,
        DB_NAME
    );
    if (!$connect) {
        trigger_error(mysqli_connect_error(), E_USER_ERROR);
    }
    mysqli_set_charset($connect, "utf8");

    // Mã hóa lệnh sql
    // $query_msg = htmlspecialchars($query_msg);
    // $query_msg = mysqli_real_escape_string($connect, $query_msg);


    $result = mysqli_query($connect, $query_msg) or trigger_error(mysqli_error($connect), E_USER_ERROR);

    mysqli_close($connect);

    return $result;
}

// Hàm này không trả về gì cả
function sql_cmd(string $query_msg) {
    $connect = mysqli_connect(
        SERVER_NAME,
        USERNAME,
        PASSWORD,
        DB_NAME
    );
    if (!$connect) {
        trigger_error(mysqli_connect_error(), E_USER_ERROR);
    }
    mysqli_set_charset($connect, "utf8");


    mysqli_query($connect, $query_msg) or trigger_error(mysqli_error($connect), E_USER_ERROR);

    mysqli_close($connect);
}