<?php
$notification_title = "Quản lý câu hỏi";
$return_path = "/manager/questions/question-insert.php";
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
        'question' => htmlspecialchars($_POST["question"] ?? null),
        'answer' => htmlspecialchars($_POST["answer"] ?? null)
    ];
} else {
    display_notification_page(
        false,
        $notification_title,
        "404",
        "Không tìm thấy trang",
        "Quay lại"
        // Quay về trang trước đó
    );
    exit();
}

// Kiểm tra tính hợp lệ của dữ liệu
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

// Insert new customer into database
sql_cmd("
    INSERT INTO qna(question, answer)
    VALUE ('{$qna["question"]}', '{$qna["answer"]}');
");
display_notification_page(
    false,
    $notification_title,
    "Thêm thành công",
    "",
    "Quay lại",
    "/manager/questions/questions-manager.php"
);
