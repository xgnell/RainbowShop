<?php
$notification_title = "Quản lý câu hỏi";
$return_path = "/manager/questions/question-update.php";
$root_path = $_SERVER["DOCUMENT_ROOT"];

// Check signed in
require_once($root_path . "/manager/templates/check-admin-signed-in.php");
check_admin_signed_in(2);

require_once($root_path . "/config/db.php");
require_once($root_path . "/manager/templates/notification-page.php");


// Get all input data
$qna = null;
if (!empty($_POST)) {
    $qna = [
        'id' => $_POST["id"] ?? null,
        'question' => $_POST["question"] ?? null,
        'answer' => $_POST["answer"] ?? null
    ];
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

// Kiểm tra tính hợp lệ
if ($qna['id'] == null) {
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

/* Kiểm tra tính hợp lệ của id */
if (!is_numeric($qna['id'])) {
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
$qna_id_db = sql_query("
    SELECT *
    FROM qna
    WHERE id = {$qna['id']};
");
if (mysqli_num_rows($qna_id_db) != 1) {
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
$return_path .= "?id={$qna['id']}";


if ($qna['question'] == null) {
    display_notification_page(
        false,
        $notification_title,
        "Câu hỏi không để trống",
        "",
        "Thử lại",
        $return_path
    );
    exit();
}

if ($qna['answer'] == null) {
    display_notification_page(
        false,
        $notification_title,
        "Câu trả lời không để trống",
        "",
        "Thử lại",
        $return_path
    );
    exit();
}


// Mã hóa dữ liệu
foreach ($qna as $key => $value) {
    $qna[$key] = htmlspecialchars($value);
}


// Update selected customer in database
sql_cmd("
    UPDATE qna
    SET question = '{$qna["question"]}', answer = '{$qna["answer"]}'
    WHERE id = {$qna["id"]};
");
display_notification_page(
    false,
    $notification_title,
    "Sửa thành công",
    "",
    "Quay lại",
    "/manager/questions/questions-manager.php"
);